----------------------------
Addon: imgattr
----------------------------
Version: 2.1.0-pl1
Since: 2013-04-11 18:22:00
Author: YJ Tso @sepiariver
License: GNU GPLv2 (or later at your option)
NO WARRANTIES, NO LIABILITY

An output filter that returns attributes from an image file, using PHP getimagesize().

Thanks for using MODx Revolution.

YJ Tso
yj@modx.com

----------------------------
USAGE
----------------------------
Where the value of [[*image_tv]] is "assets/images/photo.jpg" with dimensions 100px x 50px.

[[*image_tv:imgattr=`filename`]] => 'photo.jpg'
[[*image_tv:imgattr=`filenameNoExt`]] => 'photo'
[[*image_tv:imgattr=`width`]] => '100'
[[*image_tv:imgattr=`height`]] => '50'
[[*image_tv:imgattr=`dimensions`]] => 'width="100" height="50"'
[[*image_tv:imgattr=`mime`]] => 'image/jpeg'
