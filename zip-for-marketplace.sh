rm -rf tmp
mkdir -p tmp/sendcloudapi
cp -R classes tmp/sendcloudapi
cp -R config tmp/sendcloudapi
cp -R docs tmp/sendcloudapi
cp -R override tmp/sendcloudapi
cp -R sql tmp/sendcloudapi
cp -R src tmp/sendcloudapi
cp -R translations tmp/sendcloudapi
cp -R views tmp/sendcloudapi
cp -R upgrade tmp/sendcloudapi
cp -R vendor tmp/sendcloudapi
cp -R index.php tmp/sendcloudapi
cp -R logo.png tmp/sendcloudapi
cp -R sendcloudapi.php tmp/sendcloudapi
cp -R config.xml tmp/sendcloudapi
cp -R LICENSE tmp/sendcloudapi
cp -R README.md tmp/sendcloudapi
cd tmp && find . -name ".DS_Store" -delete
zip -r sendcloudapi.zip . -x ".*" -x "__MACOSX"
