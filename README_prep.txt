
Directions for preparing ROYG Brain Image Viewer:
montages (for each axial direction)
contours & label lists (for map highlights)

(c) 2010 arno klein, arno@mindboggle.info

--------------------------------------------------------------------------------
make_montages.py
--------------------------------------------------------------------------------
Create a .png montage from an LPI brain image volume for slices along each axis.
Optionally replace intensities with RGB values from an XML file.

First, orient the image volume to be LPI.
(LPI: x: left-to-right, y: posterior-to-anterior, z: inferior-to-superior)
One can do this using the Advanced Normalization Tools (ANTs) from UPenn:
  PermuteFlipImageOrientationAxes 3 image.nii.gz image2.nii.gz 0 2 1 1 0 1
  CopyImageHeaderInformation image.nii.gz image2.nii.gz image2.nii.gz 1 1 1

Arguments:  <input file> <output stem> <0 or 1 (relabel with XML)> <opt: XML>

Example montage from (0-255) images: 
python step1_make_montages.py ../data/subjects/1002/3/NIFTI/LPI/1002.nii.gz ../montages/1002 0

Example montage from labeled images:
python step1_make_montages.py ../data/subjects/1002/3/NIFTI/LPI/1002_glm.nii.gz \
       ../montages/1002_glm 1 \
       ../data/subjects/1002/3/NIFTI/1002_3_glm_LabelMap.xml

--------------------------------------------------------------------------------
format_montage.py
--------------------------------------------------------------------------------
Format montages (and scale main coronal montages to match label outline dimensions).

Example:
python format_montage.py ../montages/1002_x.png 1 jpg 40
python format_montage.py ../montages/1002_y.png 1 jpg 40
python format_montage.py ../montages/1002_z.png 1 jpg 40
python format_montage.py ../montages/1002_y.png 2 jpg 40 
python format_montage.py ../montages/1002_glm_y.png 2 png 100

--------------------------------------------------------------------------------
make directory for coronal contour and label information
--------------------------------------------------------------------------------
mkdir ../contours/1002

--------------------------------------------------------------------------------
make_label_file.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information from XML file and create a label array and list.

Example:
python make_label_files.py ../data/subjects/1002/3/NIFTI/1002_3_glm_LabelMap.xml ../contours/1002/labels

--------------------------------------------------------------------------------
make_contour_map.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information and contour information from XML files
and create arrays (map images) for image mouseover highlights.

Example:
python make_contour_map.py ../data/subjects/1002/3/NIFTI/1002_3_glm_LabelMap.xml \
                           ../data/subjects/1002/3/otl/ ../contours/1002/ \
                           ../contours/1002/labels.php 0 -20 0 1 512

