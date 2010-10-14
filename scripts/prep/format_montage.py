#!/usr/bin/env pythonw
# encoding: utf-8
"""
Format montages (and scale main coronal montages to match label outline dimensions).

Example:
python format_montage.py ../../montages/1013_3_axis3.png 1 jpg 40
python format_montage.py ../../montages/1013_3_axis1.png 1 jpg 40
python format_montage.py ../../montages/1013_3_axis2.png 2 jpg 40 
python format_montage.py ../../montages/1013_3_axis2.png 1 jpg 40
python format_montage.py ../../montages/1013_3_labels_colors_axis2.png 2 png 100

(c) MIT license 2010, arno klein . arno@mindboggle.info
"""

import os, sys

in_montage = sys.argv[1] 	# Ex:	"../../montages/1013_3_axis2.png"
scale = sys.argv[2] 		# Ex:	"2"
format = sys.argv[3] 		# Ex:	"jpg"
quality = sys.argv[4] 		# Ex:	"60"

out_montage = '/'.join(in_montage.split('/')[0:-1])
file_stem = '/'.join(in_montage.split('/')[-1].split('.')[0:-1])
#format = '.'+in_montage.split('/')[-1].split('.')[-1]

scalepercent = str(float(scale)*100)+'%'

cmd = 'convert -format ' + format + ' -quality ' + quality + ' ' + in_montage + ' -scale ' + scalepercent + ' ' + out_montage+'/'+file_stem+'_'+scale+'x.'+format
print(cmd)
os.system(cmd)
