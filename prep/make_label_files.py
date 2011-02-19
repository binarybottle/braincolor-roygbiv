"""
Extract label information from XML file and create a label array and list.

Example:
python make_label_files.py ../data/subjects/1002/3/NIFTI/1002_3_glm_LabelMap.xml ./contours/1002/labels

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
in_xml_labels = sys.argv[1] # Ex: "../data/subjects/1002/3/NIFTI/1002_3_glm_LabelMap.xml"
out_labels = sys.argv[2]    # Ex: "./contours/1002/labels"  # array: .js and list: .php
make_array = 0
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

# List
labelnames   = []
labelnumbers = []
labelcolors  = []
flist = open(out_labels+'.php',"w")
flist.write("<b>Coronal labels</b> ("+in_xml_labels.split('/')[-1]+"):<br />")
leftlabels  = ''
rightlabels = ''
otherlabels = ''

for iLabel in range(len(Names)):

    labelnames.append(Names[iLabel].text)
    labelnumbers.append(IDs[iLabel].text)
    rgb_list = Colors[iLabel].text.split(" ")
    rgb_tuple = (int(rgb_list[0]),int(rgb_list[1]),int(rgb_list[2]))
    labelcolors.append(RGBToHTMLColor(rgb_tuple))
    
    # Array
    if make_array:
        flabels = open(out_labels+'.js',"w")
        flabels.write('labelnames=["'   + '","'.join(labelnames)   + '"];\n')
        flabels.write('labelcolors=["'  + '","'.join(labelcolors)  + '"];\n')
        flabels.write('labelnumbers=['  +   ','.join(labelnumbers) +  '];\n')
        flabels.close()

    # List
    labelname = Names[iLabel].text
    if labelname not in exclude_list:
        if "Left" in labelname:
            leftlabels += labelname+'<br />'
        elif "Right" in labelname:
            rightlabels += labelname+'<br />'
        else:
            otherlabels += labelname+'<br />'
        print(labelname)

flist.write('<table align="left" valign="top"><tr><td align="left" valign="top">' + leftlabels + '</td><td align="left" valign="top">' + \
    rightlabels + '</td><td align="left" valign="top">' + otherlabels + '</td></tr><table>')

flist.close()
if make_array:
    flabels.close()


