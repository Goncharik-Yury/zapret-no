function dayTime()
{
	var d = new Date();
	var h = d.getHours();
	if(h >=0 && h <=5)
	alert("Доброй ночи");
	if ( h >=6 && h <=11)
	alert("Доброе утро");
	if ( h >=12 && h <=17)
	alert("Доброй день");
	if( h >=18 && h <=23)
	alert("Доброй вечер");
}

function startTime()
{
	var tm=new Date();
	var h=tm.getHours();
	var m=tm.getMinutes();
	var s=tm.getSeconds();
	h=zeroAdd(h);
	m=zeroAdd(m);
	s=zeroAdd(s);
	document.getElementById('time').innerHTML=h+":"+m+":"+s;
	t=setTimeout('startTime()',500);
}

function zeroAdd(i)
{
	if (i<10)
	{
		i="0" + i;
	}
	return i;
}