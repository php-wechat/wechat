#!/bin/bash
function config_remove {
	rm -rf  $(pwd)/wechat/Page/Conf/config.php
	rm -rf  $(pwd)/wechat/Acenter/Conf/config.php
	rm -rf  $(pwd)/wechat/Cli/Conf/config.php
	rm -rf  $(pwd)/wechat/Common/Conf/config.php
	rm -rf  $(pwd)/wechat/Script/Conf/config.php
	rm -rf  $(pwd)/wechat/Server/Conf/config.php
	rm -rf  $(pwd)/wechat/Ucenter/Conf/config.php
	echo "配置文件移除成功"	
}

function config_update {
	cp -r /xyz/$member/wechat/wechat/Page/Conf/config.php $(pwd)/wechat/Page/Conf/
	cp -r /xyz/$member/wechat/wechat/Acenter/Conf/config.php $(pwd)/wechat/Acenter/Conf/
	cp -r /xyz/$member/wechat/wechat/Cli/Conf/config.php $(pwd)/wechat/Cli/Conf/
	cp -r /xyz/$member/wechat/wechat/Common/Conf/config.php $(pwd)/wechat/Common/Conf/
	cp -r /xyz/$member/wechat/wechat/Script/Conf/config.php $(pwd)/wechat/Script/Conf/
	cp -r /xyz/$member/wechat/wechat/Server/Conf/config.php $(pwd)/wechat/Server/Conf/
	cp -r /xyz/$member/wechat/wechat/Ucenter/Conf/config.php $(pwd)/wechat/Ucenter/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Page/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Acenter/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Cli/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Common/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Script/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Server/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Ucenter/Conf/
    echo "配置文件更新成功"
}

if [[ $1 == '' ]]; then
	read -p "请输入对配置文件的操作  (update/remove/none):" domain;
	k=$domain;
else
	k=$1;
fi


if [[ $k == 'remove' ]];  then 
 	config_remove 
elif [[ $k == 'update' ]]; then
    read -p "请输入你需要从哪个用户中复制  (kevin/xyzuat/yuncopy):" member;
	config_update
elif [[ $k == 'none' || $k == '' ]]; then
	echo "操作为空";
else
	echo "非法操作";
fi
