
Directions for preparing ROYG Brain Image Viewer:
montages (for each axial direction)
contours & label lists (for map highlights)

(c) 2011 arno klein, arno@mindboggle.info

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
python make_montages.py ../data/subjects/1013/3/NIFTI/1013_3_LPI.nii.gz ../montages/1013 0

Example montage from labeled images:
python make_montages.py ../data/subjects/1013/3/NIFTI/1013_3_glm_LPI.nii.gz \
       ../montages/1013_glm 1 \
       ../data/subjects/1013/3/NIFTI/1013_3_glm_LabelMap.xml

--------------------------------------------------------------------------------
format_montage.py
--------------------------------------------------------------------------------
Format montages (and scale main coronal montages to match label outline dimensions).

Example:
python format_montage.py ../montages/1013_x.png 1 jpg 25 0
python format_montage.py ../montages/1013_y.png 1 jpg 25 0
python format_montage.py ../montages/1013_z.png 1 jpg 25 0
python format_montage.py ../montages/1013_y.png 2 jpg 25 0
python format_montage.py ../montages/1013_glm_x.png 1 png 50 0
python format_montage.py ../montages/1013_glm_y.png 1 png 50 0
python format_montage.py ../montages/1013_glm_z.png 1 png 50 0
python format_montage.py ../montages/1013_glm_y.png 2 png 50 0

--------------------------------------------------------------------------------
make directory for coronal contour and label information
--------------------------------------------------------------------------------
mkdir ../contours/1013

--------------------------------------------------------------------------------
make_label_files.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information from XML file and create a label array and list.

Example:
python make_label_files.py ../data/subjects/1013/3/NIFTI/1013_3_glm_LabelMap.xml ../contours/1013/labels

--------------------------------------------------------------------------------
make_contour_map.py  (calls convert_colors.py)
--------------------------------------------------------------------------------
Extract label information and contour information from XML files
and create arrays (map images) for image mouseover highlights.

Example:
python make_contour_map.py ../data/subjects/1013/3/NIFTI/1013_3_glm_LabelMap.xml \
                           ../data/subjects/1013/3/otl/ ../contours/1013/ \
                           ../contours/1013/labels.php -2 -1 2 1 512

