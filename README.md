# oneindex-mod
Onedrive Directory Index

Forked from [https://github.com/donwa/oneindex](https://github.com/donwa/oneindex)

## What's Changed:

Add image thumbnail for Material layout

Folders always stick in top when sorting in Material layout

Rearrange Material layout. Show sorting buttons on `xs` screen devices

Hiding folders or files **ONLY BY NAME**. Which means hide all files and folders with same name even they are in different locations.

Api /api/ page for avoiding cross domain issue when fetching file Demo: [https://drive.mihoyo.tech/api/path=static/amigo/updateInfo.json](https://drive.mihoyo.tech/api/path=static/amigo/updateInfo.json)  

List files inside directory is request a path end with '/'
## 功能改变:

Material主题添加缩略图加载, 小屏设备也显示排序按钮, 排序时始终保持文件夹在最前

通过文件/文件夹名隐藏文件/文件夹 注意 仅通过**名称**判断 所有同名的文件和文件夹都会被隐藏 *(自己够用懒得多做判断233)*

添加api控制器避免cross domain问题以供前端获取文件 Demo: [https://drive.mihoyo.tech/api/path=static/amigo/updateInfo.json](https://drive.mihoyo.tech/api/path=static/amigo/updateInfo.json)  

请求文件夹地址则返回文件列表
## Change Log:

18-09-19: Add api controller for fetching file to avoid CORS issue. List files inside directory

18-09-17: Hide folders/files by name only

18-08-22: Image thumbnail, sorting, layout

## demo
[https://drive.mihoyo.tech/](https://drive.mihoyo.tech/)  

## Requirements, Installation, Usage, Documentation

See: [https://github.com/donwa/oneindex](https://github.com/donwa/oneindex)

## Additional Third Party

[scrollLoading.js](https://www.zhangxinxu.com/wordpress/2010/11/jquery%E9%A1%B5%E9%9D%A2%E5%9B%BE%E7%89%87%E7%AD%89%E5%85%83%E7%B4%A0%E6%BB%9A%E5%8A%A8%E5%8A%A8%E6%80%81%E5%8A%A0%E8%BD%BD%E5%AE%9E%E7%8E%B0/)

[jQuery](https://jquery.com/)