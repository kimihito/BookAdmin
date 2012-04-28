<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
</head>

<!--
<h1>書籍登録画面</h1>
<h2>いずれかの項目入力してください</h2>
<body>
	<form>
		<input type="text" name="" />
		<select>
			<option>書籍名</option>
			<option>ISBN</option>
		</select>
		<input type="submit" name="search" value="検索" /><br />
	</form>
-->

<?php
echo $form->create();
echo $form->input('search_str');
echo $form->input('type', $selectels);
echo $form->end('Save Post');
?>

	<table>
		<?php for($i=0; $i<20; $i++){ ?>
		<tr>
			<td>
				<img src="http://webcatplus.nii.ac.jp/webcatplus/images/book/9784048704861_120.jpg" />
			</td>
		</tr>
		<tr>
				<td>俺の妹が(ry </td>
		</tr>
		<tr>
				<td>出版：2000年1月1日</td>
		</tr>
		<tr>
				<td>出版社：おおおおおお</td>
		</tr>
		<tr>
				<td>著者：ああああ</td>
		</tr>
		<tr>
				<td><input type="button" value="登録" /></td>
		</tr>

		<?php } ?>
	</table>


</body>
</html>
