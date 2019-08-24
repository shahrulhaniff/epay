<hr><!-- Footer -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <footer class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-yellow">_</h5>
        <p>Universiti Sultan Zainal Abidin</p>
        <p>epayment@unisza - QR-code Web Administration System</p>
		<small>&copy; Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
      </div>
    </div>
  </footer>





<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

<!-- skrip untuk check all box borang masa print-->
<script language="JavaScript">
// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
</script>

<!-- Skrip untuk validation sila pilih salah satu checkbox untuk button cetak semua
<script type="text/javascript">
function checksemua() {
var checked=false;
	var elements = document.getElementsByName("invite[]");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		alert('Sila Pilih Salah Satu untuk Cetakan');
		return false;
	}
	else { return true; }
	//return checked;
}
</script>-->

<?php if(empty($kodcetak)){ $kodcetak = "P000"; } ?>
<script>
$(document).ready(function(){
    $('#getValue').on('click', function(){
        // Declare a checkbox array
        var chkArray = [];
		
        // Look for all checkboxes that have a specific class and was checked
        $(".chk:checked").each(function() {
            chkArray.push($(this).val());
        });
        
        // Join the array separated by the comma
        var selected;
        selected = chkArray.join('&idk%5B%5D=') ;

        // Check if there are selected checkboxes
        if(selected.length > 0){
            //alert("Selected checkboxes value: " + selected);
			window.open("../extension/html2pdf/cetak<?=$kodcetak?>.php?idk%5B%5D="+selected , '_blank');
        }else{
            alert("Sila Pilih Salah Satu untuk Cetakan.");
        }
    });
});
</script>