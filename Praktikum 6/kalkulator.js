var bil1;
var bil2;
var hasil;
var opr;
var opr_seleksi = false;

function btn(angka) {
	var display = document.getElementById("output").value;
	if (display == "0" || display == bil1) {
		display = angka; 
    } 
    else {
		display += angka;
	}
	document.getElementById("output").value = display;
}

function clr() {
	document.getElementById("output").value = "0";
	bil1 = 0;
	bil2 = 0;
	opr_seleksi = false;
}

function del(){
    var display = document.getElementById("output").value;
    var l = display.length;
    if(l == 1 && opr_seleksi == false){
        clr();
    }
    else if(l == 1 && opr_seleksi == true){
        document.getElementById("output").value = bil1;
    }
    else if(l > 1){
        document.getElementById("output").value = display.slice(0,(l-1));
    } 
}

function koma() {
	var display = document.getElementById("output").value;
	if (display.includes(".") == false) {
		display += ".";
	}
	document.getElementById("output").value = display;	
}

function btn_opr(o) {
	opr_seleksi = true;
	bil1 = parseFloat(document.getElementById("output").value);
	opr = o;
	document.getElementById("output").value = bil1;
}

function hitung() {
	if (opr_seleksi == true) {
		bil2 = parseFloat(document.getElementById("output").value);
		switch(opr){
            case 1 :
				hasil = bil1 % bil2;
				document.getElementById("output").value = hasil;			
				break;
			case 2 :
                bil2 = bil1;
				hasil = bil1 * bil2;
				document.getElementById("output").value = hasil;
				break;
			case 3 :
				hasil = bil1 * bil2;
				document.getElementById("output").value = hasil;			
				break;
			case 4 :
				hasil = bil1 / bil2;
				document.getElementById("output").value = hasil;
				break;
			case 5 :
				hasil = bil1 - bil2;
				document.getElementById("output").value = hasil;
				break;
			case 6 :
				hasil = bil1 + bil2;
				document.getElementById("output").value = hasil;
				break;
		}
		opr_seleksi = false
		hasil = 0;
		bil1 = 0;
		bil2 = 0;
	}
}