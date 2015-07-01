#!/bin/bash
function config_remove {
	rm -rf  $(pwd)/wechat/Page/Conf/
	rm -rf  $(pwd)/wechat/Acenter/Conf/
	rm -rf  $(pwd)/wechat/Cli/Conf/
	rm -rf  $(pwd)/wechat/Common/Conf/
	rm -rf  $(pwd)/wechat/Script/Conf/
	rm -rf  $(pwd)/wechat/Server/Conf/
	rm -rf  $(pwd)/wechat/Ucenter/Conf/
	rm -rf  $(pwd)/ThinkPHP/
	echo "配置文件移除成功"	
}

function config_update {
	cp -r /xyz/wechat/www/wechat/Page/Conf/ $(pwd)/wechat/Page/Conf/
	cp -r /xyz/wechat/www/wechat/Acenter/Conf/ $(pwd)/wechat/Acenter/Conf/
	cp -r /xyz/wechat/www/wechat/Cli/Conf/ $(pwd)/wechat/Cli/Conf/
	cp -r /xyz/wechat/www/wechat/Common/Conf/ $(pwd)/wechat/Common/Conf/
	cp -r /xyz/wechat/www/wechat/Script/Conf/ $(pwd)/wechat/Script/Conf/
	cp -r /xyz/wechat/www/wechat/Server/Conf/ $(pwd)/wechat/Server/Conf/
	cp -r /xyz/wechat/www/wechat/Ucenter/Conf/ $(pwd)/wechat/Ucenter/Conf/
	cp -r /xyz/wechat/www/ThinkPHP/ $(pwd)/ThinkPHP/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Page/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Acenter/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Cli/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Common/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Script/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Server/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/wechat/Ucenter/Conf/
	chown -R $(whoami| awk '{print $1}'):$(whoami| awk '{print $1}') $(pwd)/ThinkPHP/
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
	config_update
elif [[ $k == 'none' || $k == '' ]]; then
	echo "操作为空";
else
	echo "非法操作";
fi