"""
Extract label information and contour information from XML files
and create arrays (map images) for image mouseover highlights.

Example:
python make_contour_map.py ../data/subjects/1013/3/NIFTI/1013_3_glm_LabelMap.xml \
                           ../data/subjects/1013/3/otl/ ../contours/1013/ \
                           ../contours/1013/labels.php 0 -20 0 1 512


Parse label XML file:

<LabelList>
<Label>
  <Name>3rd Ventricle</Name>
  <Number>4</Number>
  <RGBColor>204 182 142</RGBColor>
</Label>
...

Parse slice contour XML label files 
to extract Javascript-ready polygons:

<OutlineFile>

<NVMImageInfo>
  <NVMImageSizeCR>512 512</NVMImageSizeCR>
  <NVMImageCenterRXZY>0.000000 0.000000 0.000000</NVMImageCenterRXZY>
  <NVMImageVoxSizeXZY>0.000000 0.000000 0.000000</NVMImageVoxSizeXZY>
  <NVMImageScaleXZY>0.000000 0.000000 0.000000</NVMImageScaleXZY>
  <NVMImageRotationsXZY>0.000000 0.000000 0.000000</NVMImageRotationsXZY>
</NVMImageInfo>

<OutlineList>

<Outline>
  <Type>EXTRACTED</Type>
  <Label>Left Cerebral Exterior</Label>
  <NumEnclosedPixels>944</NumEnclosedPixels>
  <NumberOfSeeds>1</NumberOfSeeds>
  <Seed>
    210 260
  </Seed>
  <NumberOfPoints>131</NumberOfPoints>
  <PointsCR>
    210 259
    209 259
 ...
 
 
Create image map polygons for use with the jquery maphilight plugin:

Demo from http://davidlynch.org/js/maphilight/docs/

<img class="map" src="demo_usa.png" width="960" height="593" usemap="#usa">
<map name="usa">
 <area href="#" title="SC" shape="poly" coords="735,418, 734,419, 731,418,..."></area>
 ...
</map>

(c) 2010 arno klein . arno@mindboggle.info . http://www.braincolor.org (MIT license)
"""

import os, sys
from xml.etree.ElementTree import ElementTree
from convert_colors import RGBToHTMLColor

# Inputs
in_xml_labels = sys.argv[1]  # Ex: "../../data/subjects/1013_3/3/NIFTI/1013_3_glm_LabelMap.xml"
path_contours = sys.argv[2]  # Ex: "../../data/subjects/1013_3/3/otl/"
out_path      = sys.argv[3]  # Ex: "../../contours/1013_3/"
full_label_list_link = sys.argv[4]  # Ex: "../../contours/1013_3/label_list.php"
xdiff = int(sys.argv[5])  # sagittal offset:   add to contour x values
ydiff = int(sys.argv[6])  # coronal offset:    add to contour slice numbers
zdiff = int(sys.argv[7])  # horizontal offset: add to contour z values
flipx = int(sys.argv[8])  # flip x (subtract from scaled_xdim)
scaled_xdim = int(sys.argv[9])  # x dimension, scaled to match the contours

# Parameters
labels_width = 512  # table width displaying list of labels per slice
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

labelnames   = []
labelnumbers = []
labelcolors  = []

for iLabel in range(len(Names)):
    labelnames.append(Names[iLabel].text)
    labelnumbers.append(IDs[iLabel].text)
    
    rgb_list = Colors[iLabel].text.split(" ")
    rgb_tuple = (int(rgb_list[0]),int(rgb_list[1]),int(rgb_list[2]))
    labelcolors.append(RGBToHTMLColor(rgb_tuple))

# Extract contour information
dirList = os.listdir(path_contours)
max_count = 0
for fname in dirList:
    if ".xml" in fname and "Landmark" not in fname:
        slicenumber = ''.join(i for i in fname if i.isdigit())
        newslicenumber = str( int(slicenumber) + ydiff )
        
        out_contours = out_path + "slice" + newslicenumber + ".html"
        fcontours = open(out_contours,"w")
        fcontours.write('<script type="text/javascript">')
        fcontours.write('$(function(){ $(".map").maphilight(); });')
        fcontours.write('</script>')
        fcontours.write('<map name="contour_map">')
        
        tree = ElementTree()
        p = tree.parse(path_contours + fname)
        Labels = tree.findall("OutlineList/Outline/Label")
        Points = tree.findall("OutlineList/Outline/PointsCR")
        
        """
        # Example:
        $(function() {
            $('.map').maphilight();
            $('#squidheadlink').mouseover(function(e) {
                $('#squidhead').mouseover();
            }).mouseout(function(e) {
                $('#squidhead').mouseout();
            }).click(function(e) { e.preventDefault(); });
        });
        <a id="squidheadlink" href="#">mouse over this external element</a>
        """
        out_labels = out_path + "slice" + newslicenumber + "_labellist.html"
        flabels = open(out_labels,"w")
        #flabels.write('<script type="text/javascript">')
        #flabels.write('$(function() { $(".map").maphilight();')
        leftlabels  = ''
        rightlabels = ''
        otherlabels = ''

        for iLabel in range(len(Labels)):
            labelname   = Labels[iLabel].text
            
            if labelname not in exclude_list:
         
                #flabels.write('$(function() { $(".map").maphilight();')
                #flabels.write('$("#'+labelname+'link").mouseover(function(e) {')
                #flabels.write('$("#'+labelname+'").mouseover();')
                #flabels.write('}).mouseout(function(e) {')
                #flabels.write('$("#'+labelname+'").mouseout();')
                #flabels.write('}).click(function(e) { e.preventDefault(); });};')
            
                if "Left" in labelname:
                 #leftlabels += '<a class="link" id="'+labelname+'link" href="#">'+labelname+'</a><br />\n'
                 leftlabels += labelname+'<br />\n'
                elif "Right" in labelname:
                 #rightlabels += '<a class="link" id="link:'+labelname+'" href="#">'+labelname+'</a><br />\n'
                 rightlabels += labelname+'<br />\n'
                else:
                 #otherlabels += '<a class="link" id="link:'+labelname+'" href="#">'+labelname+'</a><br />\n'
                 otherlabels += labelname+'<br />\n'
            
                labelnumber = labelnumbers[labelnames.index(labelname)]
                labelcolor  = labelcolors[labelnames.index(labelname)].strip("#")
                xzvec = []
                points_text = Points[iLabel].text
                points_list = points_text.split('\n') 
                for ipoints in range(len(points_list)):
                    points_vec = points_list[ipoints].split(' ')
                    if len(points_vec) > 1 and \
                           points_vec[-2] != '' and \
                           points_vec[-1] != '':
                        xnew  = int(points_vec[-2]) + xdiff 
                        znew  = int(points_vec[-1]) + zdiff 
                        if flipx:
                            xnew = scaled_xdim - xnew
                        xzvec.append(str(xnew))  
                        xzvec.append(str(znew))  

                print("slice " + newslicenumber + ":   " + labelname)
            
                area = '<area title="' + labelname + '" href="#" shape="poly" coords="' + \
                  ",".join(xzvec) + \
                  '" class="{fillColor:\'' + labelcolor + '\'}"></area>'
                fcontours.write(area)
       
        fcontours.write("</map>")
        fcontours.close()
        
        flabels.write('</script>')
        flabels.write('<b>Coronal slice ' + newslicenumber + ' labels</b> ')
        flabels.write('(<a href="'+full_label_list_link+'" onClick="return popup('+full_label_list_link+')">full label list</a>):<br />')
        flabels.write('<table align="left" valign="top" width="'+str(labels_width)+'px"><tr><td align="left" valign="top"><font size="2">' + leftlabels + '</font></td><td align="left" valign="top"><font size="2">' + \
         rightlabels + otherlabels + '</font></td></tr><table>')
        flabels.close()
      
