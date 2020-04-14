	function formatDate(date) {
		var monthNames = [
			"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

		var day = date.getDate();
		var monthIndex = date.getMonth();
		var year = date.getFullYear();
		return day + ' ' + monthNames[monthIndex] + ' ' + year;
	}
	
    $(".sidebar-dropdown > a").click(function() {
  		$(".sidebar-submenu").slideUp(200);
  		if ($(this).parent().hasClass("active")) {
    		$(".sidebar-dropdown").removeClass("active");
    		$(this).parent().removeClass("active");
  		} else {
    		$(".sidebar-dropdown").removeClass("active");
    		$(this).next(".sidebar-submenu").slideDown(200);
    		$(this).parent().addClass("active");
  		}
	});

	$("#close-sidebar").click(function() {
  		$(".page-wrapper").removeClass("toggled");
	});
	$("#show-sidebar").click(function() {
  		$(".page-wrapper").addClass("toggled");
	});
	function closeLoading(){
	    $("body").css({ overflow: 'inherit' })
	    $('#loading').fadeOut();
	    $('#loading_con').fadeOut();
	}

	function openLoadingDialog(){
		$("body").css({overflow: 'hidden'});
		$('#loading').show();

	}
	$(window).on('beforeunload', function() {
	    openLoadingDialog();
	});
