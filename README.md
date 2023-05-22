# contact_form

```
CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sex` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `birth` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
```

以上為資料表的設計<br>
index.php 為 首頁(資料顯示頁面)<br>
action.php 為 資料撈取新增頁面
