<html>
<head>
</head>
<body>
<p>Description <br>
<textarea rows="8" cols="80"><?php echo $description; ?></textarea>
</p>
<p>Code<br>
<form method="post" action="<?php echo base_url('problem/commit');?>">
<textarea name="code" rows="8" cols="80"><?php echo $code; ?></textarea><br>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
<input type="submit" value="Submit">
</form>
</p>
<p>Console<br>
<textarea rows="8" cols="80"><?php echo $console; ?></textarea>
</p>
</body>
</html>