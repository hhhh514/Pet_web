<!DOCTPYE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>pet game</title>
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<center>
			<h1 align="center">pet game</h1>
			<form action="db_add.php" method="post" >
				<table border="1" align="center" width="300px">
					<tr>
						<th>欄位</th>
						<th>資料</th>
					</tr>
					<tr>
						<td>姓名</td>
						<td align="center"><input type="text" name="name" required="required"></td>
					</tr>
						<td>密碼</td>
						<td align="center"><input type="password" name="password" required="required"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" value="登陸">
							<input type="reset"  value="重新填寫">
							<input type="button" onclick="javascript:location.href='add.php'" value="註冊">
						</td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>
