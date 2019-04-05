# PHP MediaServer for ComicGlass

PHP で書かれた [ComicGlass](http://comicglass.net/) 用 MediaServer.

*Read this in other languages: [English](README.md)*

## セットアップ方法

1. FTP等を使ってWebサーバに全てアップロード
2. 「config.dist.php」を「config.php」にリネーム
3. 同じディレクトリに任意のディレクトリやファイルを追加またはアップロード

## 認証のセットアップ方法

ComicGlass はBasic認証をサポートしています。

1. Webサーバ上でBasic認証のユーザをセットアップ (Apacheでは「.htpasswd」)
2. 「.htaccess.dist」を「.htaccess」にリネームして、ユーザを追加するよう編集.
3. HTTPS接続を強制するようホスティング設定、または「.htaccess」内のセクションのコメントを外す

## 必須要件

* PHP 7.2 =< (Windowsで日本語のディレクトリ名やファイル名を使用する場合)

