# CheckSSLProxyOrNot
Created by Takahiro Aya on 2015/12/30.  
Copyright © 2015年 Takahiro Aya. All rights reserved.  
  
## Description
This program is check proxy alive or not.  
You can check http or https.  
  
・世の中に公開されているプロキシから生存精査することができます。  
・内部的には、一覧から順番にアクセスし、生存確認を行います。  
・徴は、http はもちろん、https のチェックもできます。  
  
## Setup
clone https://github.com/pt106/CheckSSLProxyOrNot.git  
  
## Usage
php check_ssl_proxy.php [ip:port File] [check url]  
  
## Example
php check_ssl_proxy.php test.txt http://example.com  
  
## File Example
192.168.1.1:80  
192.168.1.2:8080  

