"""
Create a .png montage from an LPI brain image volume for slices along each axis.
Optionally replace intensities with RGB values from an XML file.

Inputs:  LPI brain image volume
(LPI: x: left-to-right, y: posterior-to-anterior, z: inferior-to-superior)
Arguments:  <input file> <output stem> <0 or 1 (relabel with XML)> <opt: XML>

Example montage from (0-255) images: 
python step1_make_montages.py ../data/subjects/1013/3/NIFTI/LPI/1013.nii.gz ../montages/1013 0

Example montage from labeled images:
python step1_make_montages.py ../data/subjects/1013/3/NIFTI/LPI/1013_glm.nii.gz \
       ../montages/1013_glm 1 \
       ../data/subjects/1013/3/NIFTI/1013_3_glm_LabelMap.xml

(c) MIT license 2010, arno klein . arno@mindboggle.info
"""

from sys        import argv
from nibabel    import load
from numpy      import shape, int, ceil, sqrt, zeros
from pylab      import rot90, plt, cm
from scipy.misc import imsave

# Input arguments
in_file      = argv[1]
out_path     = argv[2]
color_labels = int(argv[3])

if color_labels:
    from xml.etree.ElementTree import ElementTree
    in_xml_labels = argv[4]
    exclude_list = ["CSF","Left Cerebellum White Matter",
            "Left Cerebral Exterior","Left Cerebral White Matter",
            "Right Cerebellum White Matter",
            "Right Cerebral Exterior",
            "Right Cerebral White Matter","Unlabeled"]

# Function to make montages from image volume
def montage(I): 

    xdim, ydim, zdim = shape(I)
    nimages_x = int(ceil(sqrt(xdim)))
    nimages_y = int(ceil(sqrt(ydim)))
    nimages_z = int(ceil(sqrt(zdim)))
    Mx = zeros((nimages_x * zdim, nimages_x * ydim))
    My = zeros((nimages_y * zdim, nimages_y * xdim))
    Mz = zeros((nimages_z * ydim, nimages_z * xdim))
    
    # Sagittal (x)
    # switch i2 and i1 for loops to have the slice sequence
    # progress vertically rather than horizontally.
    xcount = 0
    for i1 in range(nimages_x):
        for i2 in range(nimages_x):
            xcount += 1
            if xcount < xdim:
                Mx[ i1*zdim : (i1+1)*zdim, i2*ydim : (i2+1)*ydim ] = I[xdim-xcount,::-1,:].transpose()
            else:
                break

    # Coronal (y)
    ycount = 0
    for i1 in range(nimages_y):
        for i2 in range(nimages_y):
            ycount += 1
            if ycount < ydim:
                My[ i1*zdim : (i1+1)*zdim, i2*xdim : (i2+1)*xdim ] = I[::-1,ydim-ycount,:].transpose()
            else:
                break

    # Horizontal (z)
    zcount = 0
    for i1 in range(nimages_z):
        for i2 in range(nimages_z):
            zcount += 1
            if zcount < zdim:
                Mz[ i1*ydim : (i1+1)*ydim, i2*xdim : (i2+1)*xdim ] = I[:,:,zdim-zcount].transpose()
            else:
                break

    return Mx, My, Mz, xdim, ydim, zdim, nimages_x, nimages_y, nimages_z


# Load image file
nif  = load(in_file)
data = nif.get_data()

# Create montages
Mx, My, Mz, xdim, ydim, zdim, nimages_x, nimages_y, nimages_z = montage(data)


"""
Replace colors in each montage.

Excerpt from a label XML file:
<LabelList>
<Label>
  <Name>3rd Ventricle</Name>
  <Number>4</Number>
  <RGBColor>204 182 142</RGBColor>
</Label>
"""
if color_labels:

    # Parse XML file
    tree = ElementTree()
    p = tree.parse(in_xml_labels)
    Names  = tree.findall("Label/Name")
    IDs    = tree.findall("Label/Number")
    Colors = tree.findall("Label/RGBColor")
    labelnames   = []
    labelnumbers = []
    labelcolors  = []
    for iLabel in range(len(Names)):
        labelnames.append(Names[iLabel].text)
        labelnumbers.append(IDs[iLabel].text)
        labelcolors.append(Colors[iLabel].text)

    # Create new RGB matrix
    Mx3 = zeros((shape(Mx)[0], shape(Mx)[1], 3))
    My3 = zeros((shape(My)[0], shape(My)[1], 3))
    Mz3 = zeros((shape(Mz)[0], shape(Mz)[1], 3))
    Mxyz  = [Mx,My,Mz]
    Mxyz3 = [Mx3,My3,Mz3]
    dims1 = [shape(Mx)[0],shape(My)[0],shape(Mz)[0]]
    dims2 = [shape(Mx)[1],shape(My)[1],shape(Mz)[1]]
    for iaxis in range(3):
        M  = Mxyz[iaxis]
        M3 = Mxyz3[iaxis]
        for i1 in range(dims1[iaxis]):
            for i2 in range(dims2[iaxis]):
                if str(int(M[i1,i2])) in labelnumbers:
                    ilabel = labelnumbers.index(str(int(M[i1,i2])))
                    if labelnames[ilabel] not in exclude_list:
                        labelcolor = labelcolors[ilabel].split(" ")
                        rgb = (int(labelcolor[0]),int(labelcolor[1]),int(labelcolor[2]))
                        M3[i1,i2,:] = rgb
        if   iaxis == 0:  Mx = M3
        elif iaxis == 1:  My = M3
        elif iaxis == 2:  Mz = M3

"""
Save images
  (Alternatives:)
   pylab.imsave with: cmap=cm.gist_gray for grayscale or vmax=255 for color
   scipy.misc.toimage (http://www.scipy.org/Cookbook/Matplotlib/LoadImage)
"""
#plt.gray()
imsave(out_path + '_x' + '.png', rot90(Mx,2))
imsave(out_path + '_y' + '.png', rot90(My,2))
imsave(out_path + '_z' + '.png', rot90(Mz,2))
