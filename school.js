var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
    return str;
}

document.getElementById('subfee').onkeyup = function () {
    document.getElementById('words').innerHTML = inWords(document.getElementById('subfee').value);
};


function fetchco(){
    var id = document.getElementById("cors").value;
       $.ajax({
        url:"fetchclass.php",
        method: "POST",
        data:{
            x : id
        },
        dataType: "JSON",
        success: function(data){
        document.getElementById("cofee").value = data.fee;
        document.getElementById("coname").value = data.name;
        document.getElementById("sub").value = data.sub;
        }
    })
}


function fetchst(){
    var id = document.getElementById("sid").value;
       $.ajax({
        url:"fetch_student.php",
        method: "POST",
        data:{
            x : id
        },
        dataType: "JSON",
        success: function(data){
         document.getElementById("regn").value = data.regno;
         document.getElementById("stname").value = data.stname;
         document.getElementById("stfath").value = data.stfath;
         document.getElementById("stmoth").value = data.stmoth;
         document.getElementById("ses").value = data.ses;
         document.getElementById("cors").value = data.classid;
         document.getElementById("coname").value = data.classname;
         document.getElementById("balan").value = data.balance;
         document.getElementById("mobil").value = data.mob;
         document.getElementById("addrs1").value = data.address;
                         
        }

        
    })
}


function fetchcl(){
    var id = document.getElementById("sid").value;
       $.ajax({
        url:"fetch_cl.php",
        method: "POST",
        data:{
            x : id
        },
        dataType: "JSON",
        success: function(data){
         document.getElementById("ses").value = data.ses;
         document.getElementById("fee").value = data.stfee;
         document.getElementById("cou").value = data.cid;
         
                         
        }

        
    })
}

function fetchstf(){
    var id = document.getElementById("sid").value;
       $.ajax({
        url:"fetch_staff.php",
        method: "POST",
        data:{
            x : id
        },
        dataType: "JSON",
        success: function(data){
         document.getElementById("stcode").value = data.stcodes;
         document.getElementById("stjob").value = data.stjobs;
         document.getElementById("stcat").value = data.stcats;
                                  
        }

        
    })
}