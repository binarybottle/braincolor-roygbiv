#!/usr/bin/env pythonw
# encoding: utf-8
"""
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

(c) MIT license 2011, arno klein . arno@mindboggle.info
"""

import os, sys

in_montage = sys.argv[1]  # Ex: "../../montages/1002_y.png"
scale = sys.argv[2]       # Ex: "2"
format = sys.argv[3]      # Ex: "jpg"
quality = sys.argv[4]     # Ex: "60"
flipflop = sys.argv[5]    # Ex: "0" for -flip, "1" for -flop

out_montage = '/'.join(in_montage.split('/')[0:-1])
file_stem = '/'.join(in_montage.split('/')[-1].split('.')[0:-1])
#format = '.'+in_montage.split('/')[-1].split('.')[-1]

scalepercent = str(float(scale)*100)+'%'

strff = ''
if flipflop == '1':
  strff = ' -flip '
elif flipflop == '2':
  strff = ' -flop '
cmd = 'convert -format ' + format + ' -quality ' + quality + ' ' + in_montage + strff + ' -scale ' + scalepercent + ' ' + out_montage+'/'+file_stem+'_'+scale+'x.'+format
print(cmd)
os.system(cmd)
