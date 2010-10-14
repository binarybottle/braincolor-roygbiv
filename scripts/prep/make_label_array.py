"""
Extract label information from XML file and create a label array.

Example:
python make_label_array.py ../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml ../../contours/1013_3/label_array.js

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

import sys
from xml.etree.ElementTree import ElementTree
from convert_colors import RGBToHTMLColor

# Inputs
in_xml_labels = sys.argv[1] # Ex:	"../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml"
out_labels = sys.argv[2]    # Ex:	"../../data/labels.js"

# Extract label information
tree   = ElementTree()
p      = tree.parse(in_xml_labels)
Names  = tree.findall("Label/Name")
IDs    = tree.findall("Label/Number")
Colors = tree.findall("Label/RGBColor")

labelnames   = []
labelnumbers = []
labelcolors  = []

for iLabel in range(len(Names)):
	labelnames.append(Names[iLabel].text)
	labelnumbers.append(IDs[iLabel].text)

	rgb_list = Colors[iLabel].text.split(" ")
	rgb_tuple = (int(rgb_list[0]),int(rgb_list[1]),int(rgb_list[2]))
	labelcolors.append(RGBToHTMLColor(rgb_tuple))

flabels = open(out_labels,"w")
flabels.write('labelnames=["'   + '","'.join(labelnames)   + '"];\n')
flabels.write('labelcolors=["'  + '","'.join(labelcolors)  + '"];\n')
flabels.write('labelnumbers=['  +   ','.join(labelnumbers) +  '];\n')
flabels.close()
	
