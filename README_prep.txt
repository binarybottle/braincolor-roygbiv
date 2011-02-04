
Directions for preparing ROYG Brain Image Viewer:
montages (for each axial direction)
contours & label lists (for map highlights)

(c) 2010 arno klein, arno@mindboggle.info

--------------------------------------------------------------------------------
make_montages.py
--------------------------------------------------------------------------------
First, orient the image volume to be LPI.
(LPI: x: left-to-right, y: posterior-to-anterior, z: inferior-to-superior)
One can do this using the Advanced Normalization Tools (ANTs) from UPenn:
  PermuteFlipImageOrientationAxes 3 image.nii.gz image2.nii.gz 0 2 1 1 0 1
  CopyImageHeaderInformation image.nii.gz image2.nii.gz image2.nii.gz 1 1 1

Create a .png montage from the LPI image volume for slices along each axis.
Arguments:  input file, output directory, gray=1/color=0, number dim1, number dim2

Example (grayscale): 
python make_montages.py ../../data/subjects/1002_3/3/NIFTI/1002_3_LPI.nii.gz 
						../../montages/1002_3 1 16 16
Example (labels): 
python make_montages.py ../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LPI.nii.gz 
						../../montages/1002_3_labels 0 16 16

--------------------------------------------------------------------------------
color_montages.py
--------------------------------------------------------------------------------
Parse XML label file and replace a montage png file's colors

Example:
python color_montages.py ../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml 
						 ../../montages/1002_3_labels_axis1.png 
						 ../../montages/1002_3_labels_colors_axis1.png
python color_montages.py ../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml 
						 ../../montages/1002_3_labels_axis2.png 
						 ../../montages/1002_3_labels_colors_axis2.png
python color_montages.py ../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml 
						 ../../montages/1002_3_labels_axis3.png 
						 ../../montages/1002_3_labels_colors_axis3.png

--------------------------------------------------------------------------------
format_montage.py
--------------------------------------------------------------------------------
Format montages and scale main coronal montages to match label outline dimensions.

Example:
python format_montage.py ../../montages/1002_3_labels_colors_axis2.png 2 png 100
python format_montage.py ../../montages/1002_3_axis2.png 2 jpg 60 
python format_montage.py ../../montages/1002_3_axis2.png 1 jpg 60
python format_montage.py ../../montages/1002_3_axis3.png 1 jpg 60
python format_montage.py ../../montages/1002_3_axis1.png 1 jpg 60

--------------------------------------------------------------------------------
make directory for coronal contour and label information
--------------------------------------------------------------------------------
mkdir ../../contours/1002_3

--------------------------------------------------------------------------------
make_label_array.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information from XML file and create a label array.

python make_label_array.py 	../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml
							../../contours/1002_3/label_array.js

--------------------------------------------------------------------------------
make_label_list.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information from XML file and create a label list.

Example:
python make_label_list.py ../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml
						  ../../contours/1002_3/label_list.php
--------------------------------------------------------------------------------
make_contour_map.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information and contour information from XML files
and create image map polygons for use with the jquery maphilight plugin.

Example:
python make_contour_map.py 
	../../data/subjects/1002_3/3/NIFTI/1002_3_glm_LabelMap.xml 
	../../data/subjects/1002_3/3/otl/ 
	../../contours/1002_3/
	./contours/1002_3/label_list.php 
    0 0 0 1 512

