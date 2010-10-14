import Image

"""
Parse label XML file and replace a montage png file's colors

Example:
python color_montages.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml ../../montages/1013_3_labels_axis1.png ../../montages/1013_3_labels_colors_axis1.png

python color_montages.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml ../../montages/1013_3_labels_axis2.png ../../montages/1013_3_labels_colors_axis2.png

python color_montages.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml ../../montages/1013_3_labels_axis3.png ../../montages/1013_3_labels_colors_axis3.png

XML file:

<LabelList>
<Label>
  <Name>3rd Ventricle</Name>
  <Number>4</Number>
  <RGBColor>204 182 142</RGBColor>
</Label>
"""

import sys
from xml.etree.ElementTree import ElementTree
from pylab import plt
from PIL import Image

# Input arguments
in_xml_labels = sys.argv[1] # Ex:	"../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml"
in_image      = sys.argv[2] # Ex:	"../../montages/1013_3_labels_axis1.png"
			 				#		"../../montages/1013_3_labels_axis2.png"
			 				#		"../../montages/1013_3_labels_axis3.png"
out_image     = sys.argv[3] # Ex:	"../../montages/1013_3_labels_colors_axis1.png"
			 				#		"../../montages/1013_3_labels_colors_axis2.png"
			 				#		"../../montages/1013_3_labels_colors_axis3.png"

exclude_list = ["CSF","Left Cerebellum White Matter",
				"Left Cerebral Exterior","Left Cerebral White Matter",
				"Right Cerebellum White Matter",
				"Right Cerebral Exterior",
				"Right Cerebral White Matter","Unlabeled"]


# Parse label file
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

# Replace image colors with those in the label file and scale image size
#s = 'c3d test.png -type ushort -replace 0 1 -resample 200% -interpolation NearestNeighbor -o test2.png'

image = Image.open(in_image)
data = image.getdata()
pix = list(data)
newpix = []
print(len(pix))

for ipix in range(len(pix)):
    #print(str(ipix)+' of '+str(len(pix)))
    if str(pix[ipix][0]) in labelnumbers:
	    ilabel = labelnumbers.index(str(pix[ipix][0]))
	    if labelnames[ilabel] not in exclude_list:
	    	labelcolor = labelcolors[ilabel].split(" ")
	    	rgba = (int(labelcolor[0]),int(labelcolor[1]),int(labelcolor[2]),255)
	    	newpix.append(rgba)
	    else:
			newpix.append((0,0,0,0))
    else:
		newpix.append((0,0,0,0))

newimage = image
newimage.putdata(newpix)
newimage.show()
newimage.save(out_image)
