$(document).ready(function() {
                $("#userid").focus();
                $("#reset_pass").hide();
                $("#salah").hide();
                $("#sukses").hide();
                $("#doProcess").hide();
                $("#doProcess_res").hide();
                $("#lupa").click(function(){
                    $("#log_user").hide();
                    $("#reset_pass").fadeIn("slow");
                    $("#email").focus();
                    $("#btnReset").prop("disabled", false);
                    $("#email").val("");
                    $("#token").val("");
                    $("#doProcess_res").hide();
                });

                $("#kembali").click(function(){
                    $("#log_user").fadeIn("slow");
                    $("#reset_pass").hide();
                    $("#userid").focus();
                });

                $('#reset_pass').submit(function(e) {
                    reset_password();
                    e.preventDefault();
                });

                $('#log_user').submit(function(e) {
                    $("#doProcess").show();
                    $("#loading_img").show();
                    $("#msg_txt").text(" Memeriksa pengguna...");
                    
                });

                function reset_password(){
                    var str = $("#reset_pass").serialize();
                    $.ajax({
                        type: "POST",
                        url: "rPasswd.php",
                        data: str,
                        success: function(msg){
                        console.log(msg);
                            if(msg == "OK"){
                                setTimeout("doVericatedRes()", 400);
                            }else if(msg == "Gagal"){
                                setTimeout("doVericatedResErr()", 400);
                            }
                        }
                    });
                }

            })
            function doErrorProc(){
                $("#btnLogin").prop("disabled", true);
                $("#lupa").attr("disabled","disabled");
                $("#doProcess").show();
                $("#loading_img").show();
                $("#msg_txt").css({"text-align":"center", "color":"black"});
                $("#msg_txt").text(" Memeriksa pengguna...");
                setTimeout("doError()", 2000);
            }
            function doError(){
                $("#btnLogin").prop("disabled", false);
                $("#lupa").attr("disabled", false);
                $("#doProcess").show();
                $("#loading_img").hide();
                $("#msg_txt").css({"text-align":"center", "color":"red"});
                $("#msg_txt").html("<i class='i i-cancel'></i> Nama Pengguna atau Password anda salah!!");
                $("#userid").val("");
                $("#password").val("");
                $("#userid").focus();
            }
            function doVericated(){
                $("#btnLogin").attr("disabled","disabled");
                $("#lupa").attr("disabled","disabled");
                $("#doProcess").show();
                $("#loading_img").show();
                $("#msg_txt").css({"text-align":"center", "color":"black"});
                var getLevel = localStorage.getItem('key_level');
                if(getLevel=="4" || getLevel=="2"){
                    $("#msg_txt").text(" Memeriksa pengguna...");
                }
                else{
                    //$("#msg_txt").text(" ");
                    $("#msg_txt").text(" Memeriksa pengguna...");
                }
                
                setTimeout("doRedirected()", 1000);
            }
            function doRedirected(){
                $("#loading_img").hide();
                $("#msg_txt").css({"text-align":"center", "color":"green"});
                var getLevel = localStorage.getItem('key_level');
                if(getLevel=="4" || getLevel=="2"){
                    $("#msg_txt").text("Login Sukses, Mengarahkan ke dashboard...");
                }
                else{
                    $("#msg_txt").text("Login Sukses, Mengarahkan ke dashboard...");
                }
                
                setTimeout("redirDashboard()", 2800);
            }
            function redirDashboard(){
                /**
                 * window.location.href="media.php"
                 */
                 var getLevel = localStorage.getItem('key_level');
                 if(getLevel=="4" || getLevel=="2"){
                    window.location.href="jak/"
                 }
                 else{
                    window.location.href="jak/"
                 }

            }

            /** Reset Password **/
            function doVericatedRes(){
                $("#lupa").attr("disabled","disabled");
                $("#btnReset").attr("disabled","disabled");
                $("#doProcess_res").show();
                $("#loading_img_res").show();
                $("#msg_txt_res").css({"text-align":"center", "color":"black"});
                $("#msg_txt_res").text("Verifikasi E-mail dan token...");
                setTimeout("doRedirectedRes()", 2000);
            }
            function doRedirectedRes(){
                $("#loading_img_res").hide();
                $("#msg_txt_res").css({"text-align":"center", "color":"green"});
                $("#msg_txt_res").text("Sukses, silahkan periksa e-mail anda");
            }

             function doVericatedResErr(){
                $("#lupa").attr("disabled","disabled");
                $("#btnReset").attr("disabled","disabled");
                $("#doProcess_res").show();
                $("#loading_img_res").show();
                $("#msg_txt_res").css({"text-align":"center", "color":"black"});
                $("#msg_txt_res").html(" Verifikasi E-mail dan token...");
                setTimeout("doRedirectedResErr()", 2000);
            }
            function doRedirectedResErr(){
                $("#email").focus();
                $("#email").val("");
                $("#token").val("");
                $("#btnReset").prop("disabled", false);
                $("#loading_img_res").hide();
                $("#msg_txt_res").css({"text-align":"center", "color":"red"});
                $("#msg_txt_res").html("<i class='i i-cancel'></i> Email atau Token anda salah!!");
            }