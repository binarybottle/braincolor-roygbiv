"""
Extract label information from XML file and create a label list.

Example:
python make_label_list.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml ../../contours/1013_3/label_list.php

Parse label XML file:

<LabelList>
<Label>
  <Name>3rd Ventricle</Name>
  <Number>4</Number>
  <RGBColor>204 182 142</RGBColor>
</Label>
...

(c) 2010 arno klein . arno@mindboggle.info . http://www.braincolor.org (MIT license)
"""

import os, sys
from xml.etree.ElementTree import ElementTree
from convert_colors import RGBToHTMLColor

# Inputs
in_xml_labels  = sys.argv[1] # Ex:	"../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml"
out_label_list = sys.argv[2] # Ex:	"../../contours/1013_3/label_list.php"
	
# Parameters
exclude_list = ["CSF","Left Cerebellum White Matter",
 				"Left Cerebral Exterior","Left Cerebral White Matter",
 				"Right Cerebellum White Matter",
 				"Right Cerebral Exterior",
 				"Right Cerebral White Matter","Unlabeled"]

# Extract label information
tree   = ElementTree()
p      = tree.parse(in_xml_labels)
Names  = tree.findall("Label/Name")
IDs    = tree.findall("Label/Number")
Colors = tree.findall("Label/RGBColor")

flabels = open(out_label_list,"w")
flabels.write("<b>Coronal labels</b> ("+in_xml_labels.split('/')[-1]+"):<br />")
leftlabels  = ''
rightlabels = ''
otherlabels = ''
for iLabel in range(len(Names)):
	labelname = Names[iLabel].text
	if labelname not in exclude_list:
		if "Left" in labelname:
			leftlabels += labelname+'<br />'
		elif "Right" in labelname:
			rightlabels += labelname+'<br />'
		else:
			otherlabels += labelname+'<br />'
		print(labelname)

flabels.write('<table align="left" valign="top"><tr><td align="left" valign="top">' + leftlabels + '</td><td align="left" valign="top">' + \
				rightlabels + '</td><td align="left" valign="top">' + otherlabels + '</td></tr><table>')
flabels.close()
