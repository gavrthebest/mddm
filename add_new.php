<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Документ без названия</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/autoresize.jquery.js"></script>
</head>

<body>

<? 
	include_once('config.php');
?>
<form method="get" action="add.php">
<label for="dep">Отдел</label><select name="dep" id="dep" size="1" onChange="loadLab(this)">
<option value="null">Выберите отдел</option>
<?
$dep_sql = mysql_query("SELECT * FROM Table_Departments");
while ($row = mysql_fetch_array($dep_sql)) {
	echo "<option value='".$row[DepartmentID]."'>".$row[DepartmentName]."</option>";
}
?>
</select>

<label for="lab">Сектор</label><select name="lab" id="lab" size="1">
<option>Выберите отдел</option>
</select>

<!--<label for="lab">Сектор (кабинет, лаборатория): </label><input type="text" name="lab" id="lab" value="Название" onFocus="if(this.value=='Название')this.value='';"><br>-->

<label for="cname">Кружок: </label><input type="text" name="cname" id="cname" value="Название кружка" onFocus="if(this.value=='Название кружка')this.value='';"><br>

<label for="teacher">Преподаватель: </label><input type="text" name="teacher" id="tname" value="Фамилия преподавателя" size="30" onFocus="if(this.value=='Фамилия преподавателя')this.value='';"><br>

<label for="agemin">Минимальный возраст: </label><select size="1" name="agemin" id="agemin" onChange="showAgeMax(this.value)">

<option value="all" selected>Любой</option>
<? 
for ($i = 1; $i<100; $i++) { 	
		echo "<option value='$i'>$i</option>";
	}
?>
</select>

<label for="agemax">Максимальный возраст: </label><select size="1" name="agemax" id="agemax">
<option value="all" selected>Любой</option>
</select><br>

<label for="paid">Платный</label>
<input type="checkbox" name="paid" id="paid" onClick="PaymentState()">

<label for="payment">Стоимость</label>
<input type="text" name="payment" id="payment" value="Введите стоимость" size="30" onFocus="if(this.value=='Введите стоимость')this.value=''; $('input[name=paid]').attr('checked', true);"><br>

<label for="description">Описание</label><textarea rows="1" cols="40" name="description" id="description"></textarea> 

<table style="border:double" class="times">
<tr>
<td>
<input type="button" id="add" value="+">
<input type="button" id="remove" value="-">
</td>
</tr>
<tr>
<td>
Время проведения:<select size="1" name="day" class="day">
<option value="1">Понедельник</option>
<option value="2">Вторник</option>
<option value="3">Среда</option>
<option value="4">Четверг</option>
<option value="5">Пятница</option>
<option value="6">Суббота</option>
<option value="7">Воскресенье</option>
</select><select size="1" name="beginhour" class="beginhour">
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
</select><select size="1" name="beginmin" class="beginmin">
<option value="0">00</option>
<option value="5">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select>&mdash;<select size="1" name="endhour" class="endhour">
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
</select>
<select size="1" name="endmins" class="endmin">
<option value="0">00</option>
<option value="5">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select><br>

<label for="room">Кабинет:</label>
<select size="1" name="room" id="room" class="room">
<?
$room_sql = mysql_query("SELECT * FROM rooms ORDER BY room");
while ($row = mysql_fetch_array($room_sql)) {
	echo "<option value='".$row[id]."'>".$row[room]."</option>";
}
?>
</select><br>
</td>
</tr>
</table>
<input type="button" class="submit" value="submit">
</form>

<script>
$(function() {
	
	$('#cname').autocomplete({
		source: function(request, response) {
    		$.getJSON("search.php?cat=cname", { term: request.term }, response);
  		}
	});
	
	$('#tname').autocomplete({
		source: function(request, response) {
    		$.getJSON("search.php?cat=tname", { term: request.term }, response);
  		}
	});
});

function showAgeMax(v){
    var mas = Array();
    var el = document.getElementById('agemax');
    while(el.childNodes.length>0){
        el.removeChild(el.childNodes[el.childNodes.length-1]);
    }
	
    for(var i = v; i < 100 ; i++) {
        var opt = document.createElement("option");
		mas[i] = i;
        opt.innerHTML = mas[i];
        el.appendChild(opt);
    }
}

function PaymentState() {
	if ($('#paid').is(':checked')) {
		$('#payment:input').removeAttr('disabled');
	}
	else {
		$('#payment:input').attr('disabled', true);
	}
}

function loadLab(select)
{
    var depSelect = $('select[name="lab"]');
 
    // послыаем AJAX запрос, который вернёт список лабораторий для выбранного отдела
    $.getJSON('search.php', {cat:'labafdep', term:select.value}, function(depList){
        depSelect.html(''); // очищаем список лабораторий
 
        // заполняем список новыми пришедшими данными
        $.each(depList, function(key, val){
            depSelect.append('<option value="' + key + '">' + val + '</option>');
        });
    });
}





$(document).ready(function(){

	var i = $('input').size() + 1;

	$('#add').click(function() {
		
		$('<div class="field"><tr><td>Время проведения:<select size="1" name="day" class="day"><option value="1">Понедельник</option><option value="2">Вторник</option><option value="3">Среда</option><option value="4">Четверг</option><option value="5">Пятница</option><option value="6">Суббота</option><option value="7">Воскресенье</option></select><select size="1" name="beginhour" class="beginhour"><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option></select><select size="1" name="beginmins" class="beginmin"><option value="0">00</option><option value="5">05</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option><option value="45">45</option><option value="50">50</option><option value="55">55</option></select>&mdash;<select size="1" name="endhour" class="endhour"><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option></select><select size="1" name="endmin" class="endmin"><option value="0">00</option><option value="5">05</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option><option value="45">45</option><option value="50">50</option><option value="55">55</option></select><br><label for="room">Кабинет:</label><select size="1" name="room" id="room" class="room"><?
$room_sql = mysql_query("SELECT * FROM rooms ORDER BY room");
while ($row = mysql_fetch_array($room_sql)) {
	echo "<option value=\"".$row[id]."\">".$row[room]."</option>";
}
?></select></div>').fadeIn('slow').appendTo('.times');
		i++;
	});

	$('#remove').click(function() {
		if(i > 1) {
			$('.field:last').remove();
			i--;
    	}
    });

    $('#reset').click(function() {
    	while(i > 2) {
        	$('.field:last').remove();
        	i--;
    	}
    });

    // here's our click function for when the forms submitted

    $('.submit').click(function(){

    	var days = [];
		var beghours = [];
		var begmins = [];
		var endhours = [];
		var endmins = [];
		var rooms = [];
		var dep;
		var lab;
		var cname;
		var tname;
		var agemin;
		var agemax;
		var paid;
		var payment;
		var desc;
		
    	$.each($('.day'), function() {
        	days.push($(this).val());
    	});

    	if(days.length == 0) {
        	days = "none";
    	}

		$.each($('.beginhour'), function() {
        	beghours.push($(this).val());
    	});

    	if(beghours.length == 0) {
        	beghours = "none";
    	}
		
    	$.each($('.beginmin'), function() {
        	begmins.push($(this).val());
    	});

    	if(begmins.length == 0) {
        	begmins = "none";
    	}
		
		$.each($('.endhour'), function() {
        	endhours.push($(this).val());
    	});

    	if(endhours.length == 0) {
        	endhours = "none";
    	}
		
    	$.each($('.endmin'), function() {
        	endmins.push($(this).val());
    	});

    	if(endmins.length == 0) {
        	endmins = "none";
    	}

    	$.each($('.room'), function() {
        	rooms.push($(this).val());
    	});

    	if(rooms.length == 0) {
        	rooms = "none";
    	}
		
		if ($('#paid').is(':checked')) {
			payment = $('#payment').val();
		}
		
		$.ajax({
			type: "POST",
			url: "add2.php",
			data: {dep: $('#dep').val(), lab: $('#lab').val(), cname: $('#cname').val(), 
			tname: $('#tname').val(), agemin: $('#agemin').val(), agemax: $('#agemax').val(),
			payment: payment, desc: $('#description').val(), rooms: rooms, days: days, beghours: beghours,
			begmins: begmins, endhours: endhours, endmins: endmins},
			cache: false,

			success: function(html) {
				parent.html(html);
  			}  
			
		});
    });

	//автоизменение высоты textarea
	jQuery('textarea').autoResize();
});

</script> 
</body>
</html>