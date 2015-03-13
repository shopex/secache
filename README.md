![image](http://secache.googlecode.com/files/secache-logo.png)

This class can be used to store and retrieve cached values from single file.
It can store one or more keys in a single cache file.
The class can also look up for a given key and retrieve the store value.

It can lock the file during access to prevent corruption, but there is also a sub-class that can be used to access the cache file without locking it.

It can automatically clean-up the least recently used entries to free space

# php编写的文件型缓存解决方案
 * 纯php实现, 无须任何扩展，支持php4 / 5
 * 使用lru算法自动清理过期内容
 * 可以安全用于多进程并发
 * 最大支持1G缓存文件
 * 使用hash定位，读取迅速

[用法样例](test.php)


```
require('../secache/secache.php');
$cache = new secache;
$cache->workat('cachedata');

$key = md5('test'); //必须自己做hash，前4位是16进制0-f,最长32位。
$value = '值数据'; //必须是字符串

$cache->store($key,$value);

if($cache->fetch($key,$return)){
    echo '<li>'.$key.'=>'.$return.'</li>';
}else{
    echo '<li>Data get failed! <b>'.$key.'</b></li>';
}
```

## 基于性能考虑,几点约束
 * 键需要自己做hash处理,最长32位.
 * 值必须是字符串。如果要存对象，请自己serialize

## 应用的项目
 * [shopex购物系统](http://www.shopex.cn)


[![image](http://www.phpclasses.org/award/innovation/nominee.gif)<br />April 2010 Number 4](http://www.phpclasses.org/package/6078-PHP-Store-and-retrieve-cached-values-from-single-file.html)
