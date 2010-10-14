#!/usr/bin/env pythonw
# encoding: utf-8
"""
Create a .png montage from an LPI image volume for slices along each axis.
(LPI: x: left-to-right, y: posterior-to-anterior, z: inferior-to-superior)

Example (grayscale):
python make_montages.py ../../data/subjects/1013_3/3/NIFTI/1013_3_LPI.nii.gz ../../montages/1013_3 1 16 16 0 255 27 282 0 255
Example (labels):
python make_montages.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LPI.nii.gz ../../montages/1013_3_labels 0 16 16 0 255 27 282 0 255

Inspired by the Peter Skomoroch's website:
http://www.datawrangling.com/python-montage-code-for-displaying-arrays

(c) MIT license 2010, arno klein . arno@mindboggle.info
"""

from __future__ import division

import sys
from numpy   import shape, floor, ceil, sqrt, zeros, swapaxes, sum
from pylab   import imsave, flipud, fliplr, rot90, cm, plt
from nibabel import load

# Input arguments (more below for cropping data)
in_file  = sys.argv[1]
out_path = sys.argv[2]
graymap  = int(sys.argv[3]) # 1 if yes, 0 if no (color index labels)

def montage(I,vertical=0): 
	dim1,dim2,dim3      = shape(I)
	nimages_montagedim1 = int(sys.argv[4])
	nimages_montagedim2 = int(sys.argv[5])
	M = zeros((nimages_montagedim1 * dim1, nimages_montagedim2 * dim2))
	
	count = 0
	# switch i2 and i1 for loops to have the slice sequence 
	# progress vertically rather than horizontally:
	if vertical:
		for i1 in range(nimages_montagedim1):
			for i2 in range(nimages_montagedim2):
				if count >= dim3: 
					break
				slice1, slice2 = i1 * dim1, i2 * dim2
				M[ slice1 : slice1+dim1, slice2 : slice2+dim2 ] = I[:, :, count]
				count += 1
	else:
		for i2 in range(nimages_montagedim2):
			for i1 in range(nimages_montagedim1):
				if count >= dim3: 
					break
				slice1, slice2 = i1 * dim1, i2 * dim2
				M[ slice1 : slice1+dim1, slice2 : slice2+dim2 ] = I[:, :, count]
				count += 1
	return M


nif  = load(in_file)
data = nif.get_data()

# Crop data (in opposite directions: RAS)
if len(sys.argv) > 6:
    start1 = int(sys.argv[6])  # sagittal
    stop1  = int(sys.argv[7])  # sagittal
    start2 = int(sys.argv[8])  # coronal
    stop2  = int(sys.argv[9])  # coronal
    start3 = int(sys.argv[10]) # horizontal
    stop3  = int(sys.argv[11]) # horizontal
    if sum([start1,start2,start3,stop1,stop2,stop3]) > 0:
      print("Cropping...")
      data = data[start1:stop1+1,start2:stop2+1,start3:stop3+1]
        
for iaxis in range(1,4):
	
	out_file = out_path + '_axis' + str(iaxis) + '.png'

	plt.gray()
	
	# horizontal:
	if iaxis == 3:
		M = montage(data[::-1,:,:],0)
		if graymap:
			imsave(out_file, flipud(rot90(M)), cmap=cm.gist_gray)
		else:
			imsave(out_file, flipud(rot90(M)), vmax=255)
		
	# coronal:
	elif iaxis == 2:
		data_copy = swapaxes(data.copy(), 1, 2)
		data_copy = data_copy[::-1,::-1,::-1]
		M = montage(data_copy,0)
		if graymap:
			imsave(out_file, fliplr(rot90(M,-1)), cmap=cm.gist_gray)
		else:
			imsave(out_file, fliplr(rot90(M,-1)), vmax=255)
		
	# sagittal:
	elif iaxis == 1:
		data_copy = swapaxes(data.copy(), 0, 2)
		M = montage(data_copy,1)
		if graymap:
			imsave(out_file, fliplr(flipud(M)), cmap=cm.gist_gray)
		else:
			imsave(out_file, fliplr(flipud(M)), vmax=255)
