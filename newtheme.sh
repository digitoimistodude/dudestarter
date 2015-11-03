#!/bin/bash
# Theme starting bash script by rolle (github.com/ronilaukkarinen & github.com/digitoimistodude)

txtbold=$(tput bold)
boldyellow=${txtbold}$(tput setaf 3)
boldgreen=${txtbold}$(tput setaf 2)
boldwhite=${txtbold}$(tput setaf 7)
yellow=$(tput setaf 3)
green=$(tput setaf 2)
white=$(tput setaf 7)
txtreset=$(tput sgr0)

while true; do
read -p "${boldyellow}Project created? (y/n)${txtreset} " yn
    case $yn in
        [Yy]* ) break;;
        [Nn]* ) exit;;
        * ) echo "Please answer y or n.";;
    esac
done

# TODO:
# read -p "${boldyellow}Tuleeko teemaan asia X? (y/n)${txtreset} " CONT
# if [ "$CONT" == "y" ]; then
#   echo "yaaa";
# else
#   echo "booo";
# fi

echo "${boldyellow}Project name in lowercase:${txtreset} "
read -e PROJECTNAME
echo "${boldyellow}Theme name in lowercase (no spaces or special characters):${txtreset} "
read -e THEMENAME

# TODO:
# read -p "${boldyellow}Use as base: a) twitter bootstrap, b) skeleton?${txtreset} " CONT
# if [ "$CONT" == "a" ]; then
# BASE="bootstrap"
# else
# BASE="skeleton"
# fi

PROJECTPATH="${HOME}/Projects/${PROJECTNAME}"
STARTERTHEMEPATH="${HOME}/dudestarter"
PROJECTTHEMEPATH="${HOME}/Projects/${PROJECTNAME}/content/themes/${THEMENAME}"

echo "${yellow}Checking dudestarter updates...${txtreset}"
cd $HOME
git clone git@github.com:digitoimistodude/dudestarter.git
cd $STARTERTHEMEPATH
git pull
echo "${yellow}Copying starter theme to project folder ${HOME}/Projects/${PROJECTNAME}/content/themes/${THEMENAME}${txtreset}"

cp -R ${STARTERTHEMEPATH} ${PROJECTTHEMEPATH} 
echo "${yellow}Generating theme files${txtreset}"

sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/404.php > ${PROJECTTHEMEPATH}/404.php
echo "${boldgreen}404.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/archive.php > ${PROJECTTHEMEPATH}/archive.php
echo "${boldgreen}archive.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/comments.php > ${PROJECTTHEMEPATH}/comments.php
echo "${boldgreen}comments.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/footer.php > ${PROJECTTHEMEPATH}/footer.php
echo "${boldgreen}footer.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/header.php > ${PROJECTTHEMEPATH}/header.php
echo "${boldgreen}header.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/index.php > ${PROJECTTHEMEPATH}/index.php
echo "${boldgreen}index.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/page.php > ${PROJECTTHEMEPATH}/page.php
echo "${boldgreen}page.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/search.php > ${PROJECTTHEMEPATH}/search.php
echo "${boldgreen}search.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/sidebar.php > ${PROJECTTHEMEPATH}/sidebar.php
echo "${boldgreen}sidebar.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/front-page.php > ${PROJECTTHEMEPATH}/front-page.php
echo "${boldgreen}front-page.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/single.php > ${PROJECTTHEMEPATH}/single.php
echo "${boldgreen}single.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/functions.php > ${PROJECTTHEMEPATH}/functions.php
echo "${boldgreen}functions.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/style.css > ${PROJECTTHEMEPATH}/style.css
echo "${boldgreen}style.css generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/template-parts/content.php > ${PROJECTTHEMEPATH}/template-parts/content.php
echo "${boldgreen}content.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/template-parts/content-none.php > ${PROJECTTHEMEPATH}/template-parts/content-none.php
echo "${boldgreen}content-none.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/template-parts/content-page.php > ${PROJECTTHEMEPATH}/template-parts/content-page.php
echo "${boldgreen}content-page.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/template-parts/content-search.php > ${PROJECTTHEMEPATH}/template-parts/content-search.php
echo "${boldgreen}content-search.php generated${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" ${STARTERTHEMEPATH}/template-parts/content-single.php > ${PROJECTTHEMEPATH}/template-parts/content-single.php
echo "${boldgreen}content-single.php generated${txtreset}"

if [ "$CONT" == "b" ]; then
echo "${yellow}Generating grids for skeleton${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/404.php > ${PROJECTTHEMEPATH}/404.php
echo "${boldgreen}404.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/archive.php > ${PROJECTTHEMEPATH}/archive.php
echo "${boldgreen}archive.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/comments.php > ${PROJECTTHEMEPATH}/comments.php
echo "${boldgreen}comments.php generated${txtreset}"
echo "${yellow}Generating grids for skeleton${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/footer.php > ${PROJECTTHEMEPATH}/footer.php
echo "${boldgreen}footer.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/header.php > ${PROJECTTHEMEPATH}/header.php
echo "${boldgreen}header.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/index.php > ${PROJECTTHEMEPATH}/index.php
echo "${boldgreen}index.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/page.php > ${PROJECTTHEMEPATH}/page.php
echo "${boldgreen}page.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/search.php > ${PROJECTTHEMEPATH}/search.php
echo "${boldgreen}search.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/sidebar.php > ${PROJECTTHEMEPATH}/sidebar.php
echo "${boldgreen}sidebar.php generated${txtreset}"
sed -e "s/\col-md-2/two columns/" -e "s/\col-md-3/three columns/" -e "s/\col-md-4/four columns/" -e "s/\col-md-5/five columns/" -e "s/\col-md-6/six columns/" -e "s/\col-md-7/seven columns/" -e "s/\col-md-8/eight columns/" -e "s/\col-md-9/nine columns/" -e "s/\col-md-10/ten columns/" -e "s/\col-md-11/eleven columns/" -e "s/\col-xs-2/two columns/" -e "s/\col-xs-3/three columns/" -e "s/\col-xs-4/four columns/" -e "s/\col-xs-5/five columns/" -e "s/\col-xs-6/six columns/" -e "s/\col-xs-7/seven columns/" -e "s/\col-xs-8/eight columns/" -e "s/\col-xs-9/nine columns/" -e "s/\col-xs-10/ten columns/" -e "s/\col-xs-11/eleven columns/" ${STARTERTHEMEPATH}/single.php > ${PROJECTTHEMEPATH}/single.php
echo "${boldgreen}single.php generated${txtreset}"

# TODO:
#echo "${yellow}Generating responsive nav${txtreset}"
#awk '/bootstrap-js/ { print; print "new line"; next }1' ${PROJECTTHEMEPATH}/index.php > test.php.edited && rm test.php && mv test.php.edited test.php

fi

echo "${yellow}Setting up package.json & gulpfile.js from devpackages github${txtreset}"
cd ${PROJECTPATH}
git clone git@github.com:digitoimistodude/devpackages.git
echo "${yellow}Generating package.json from git@github.com:digitoimistodude/devpackages.git${txtreset}"
sed -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" $PROJECTPATH/devpackages/package.json > "$PROJECTPATH/package.json"
echo "${yellow}Installing and updating local node.js packages (may take a while)${txtreset}"
cd "$HOME/Projects/$PROJECTNAME"
npm-check-updates -u
sudo npm install

echo "${yellow}Generating gulpfile.js from git@github.com:digitoimistodude/devpackages.git${txtreset}"
sed -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" $PROJECTPATH/devpackages/gulpfile.js > $PROJECTPATH/gulpfile_temp.js
sed -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" $PROJECTPATH/gulpfile_temp.js > $PROJECTPATH/gulpfile.js

echo "${yellow}Generating bower.json from git@github.com:digitoimistodude/devpackages.git${txtreset}"
cp $PROJECTPATH/devpackages/.bowerrc $PROJECTPATH/
sed -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" -e "s/\THEMENAME/$THEMENAME/" $PROJECTPATH/devpackages/bower.json > $PROJECTPATH/bower_temp.json
sed -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" -e "s/\PROJECTNAME/$PROJECTNAME/" $PROJECTPATH/bower_temp.json > $PROJECTPATH/bower.json
echo "${yellow}Installing bower packages...${txtreset}"
cd ${PROJECTPATH}
bower install

echo "${yellow}Cleaning up...${txtreset}"
rm -rf $PROJECTPATH/devpackages
rm -f $PROJECTPATH/gulpfile_temp.js
rm -f $PROJECTPATH/bower_temp.json
rm -f ${PROJECTTHEMEPATH}/config.codekit
rm -f ${PROJECTTHEMEPATH}/test.php
rm -f ${PROJECTTHEMEPATH}/test2.php
rm -f ${PROJECTTHEMEPATH}/test.sh
rm -f ${PROJECTTHEMEPATH}/newtheme.sh
rm -Rf ${PROJECTTHEMEPATH}/.git
rm -f ${PROJECTTHEMEPATH}/.gitignore
rm -f ${PROJECTTHEMEPATH}/TODO.todo
rm -f ${PROJECTTHEMEPATH}/images/logo.psd
rm ${PROJECTTHEMEPATH}/README.md
echo "${yellow}Adding media library folder...${txtreset}"
mkdir -p ${PROJECTPATH}/media
chmod 777 ${PROJECTPATH}/media
echo "${yellow}Activating theme...${txtreset}"
cd ${PROJECTPATH}
ssh vagrant@10.1.2.3 "cd /var/www/$PROJECTNAME/;vendor/wp-cli/wp-cli/bin/wp theme activate $THEMENAME"
# The old MAMP way:
# ./wp-cli/wp theme activate $THEMENAME
echo "${boldgreen}All done! Theme generated and activated. Your theme can be found at $PROJECTTHEMEPATH${txtreset}"