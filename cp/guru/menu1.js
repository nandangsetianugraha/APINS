    function search_menu() {
        var text = $('input[name=q]').val();

        var $ul = $('.sidebar-menu');
        $ul.find("a.nav-link").each(function () {
            var $a = $(this).css("border", "");

            if ($a.children("span.menu-text").text().indexOf(text) >= 0) {

                $ul = $a.parents("ul");

                if ($ul.is(":hidden")) {
                    $a.parents("ul").prev().click();
                }

                $a.click().css("border", "1px solid");

//                return false;
            }
        });
    }

    $(function () {
//        console.log(window.location);

        App.setbasePath("../");
        App.setGlobalImgPath("../dist/img/");

        addTabs({
            id: '10008',
            title: 'Beranda',
            close: false,
            url: 'pages/home.php',
            urlType: "relative"
        });

        App.fixIframeCotent();

        /*addTabs({
         id: '10009',
         title: '404',
         close: true,
         url: 'UI/buttons_iframe2.html'
         });*/

        /*
         <li class="treeview">
         <a href="#">
         <i class="fa fa-edit"></i> <span>Forms</span>
         <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
         </span>
         </a>
         <ul class="treeview-menu">
         <li><a href="forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
         <li><a href="forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
         <li><a href="forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
         </ul>
         </li>
         */
        var menus = [
            {
                id: "10",
                text: "Home",
                icon: "fa fa-home",
                children: [
                    {
                        id: "10008",
                        text: "Beranda",
                        icon: "fa fa-home",
                        url: "pages/home.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "10009",
                        text: "Absensi",
                        url: "pages/myabsen.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-calendar"
                    }
                ]
            },
			{
                id: "102",
                text: "Peserta Didik",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "1021",
                        text: "Siswa",
                        icon: "fa fa-circle-o",
                        url: "pages/siswa.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "1022",
                        text: "Absensi",
                        url: "pages/absensi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "103",
                text: "Administrasi K13",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "1031",
                        text: "Tema",
                        icon: "fa fa-circle-o",
                        url: "pages/tema.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "1032",
                        text: "Kompetensi Dasar",
                        url: "pages/kompetensi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "1033",
                        text: "Pemetaan KD",
                        url: "pages/pemetaan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "1034",
                        text: "KKM",
                        url: "pages/kkm.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "104",
                text: "Penilaian Sikap",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "1041",
                        text: "Sikap Spiritual",
                        icon: "fa fa-circle-o",
                        url: "pages/spiritual.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "1042",
                        text: "Sikap Sosial",
                        url: "pages/sosial.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "105",
                text: "Penilaian",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "1051",
                        text: "Pengetahuan",
                        icon: "fa fa-circle-o",
                        url: "pages/pengetahuan.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "1052",
                        text: "Ketrampilan",
                        url: "pages/ketrampilan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
					{
                        id: "1053",
                        text: "Tengah Semester",
                        icon: "fa fa-circle-o",
                        url: "pages/pts.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "1054",
                        text: "Akhir Semester",
                        url: "pages/pas.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "106",
                text: "Data Isian Semester",
                icon: "fa fa-laptop",
                children: [
                   {
                        id: "1061",
                        text: "Kesehatan",
                        url: "pages/kesehatan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }, 
					{
                        id: "1062",
                        text: "Prestasi",
                        url: "pages/prestasi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9006",
                text: "Generate Raport",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90061",
                        text: "Sikap Spiritual",
                        icon: "fa fa-circle-o",
                        url: "pages/raportspiritual.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90062",
                        text: "Sikap Sosial",
                        url: "pages/raportsosial.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90063",
                        text: "Pengetahuan",
                        url: "pages/raportpengetahuan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90064",
                        text: "Ketrampilan",
                        url: "pages/raportketrampilan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9007",
                text: "Cetak Laporan",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90074",
                        text: "Format F1",
                        icon: "fa fa-circle-o",
                        url: "pages/formatf1.php",
                        targetType: "iframe-tab"
                    },
					{
                        id: "90073",
                        text: "Rekap Nilai",
                        icon: "fa fa-circle-o",
                        url: "pages/rekapNilai.php",
                        targetType: "iframe-tab"
                    },
					{
                        id: "90071",
                        text: "Cetak Raport",
                        icon: "fa fa-circle-o",
                        url: "pages/cetakraport.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90072",
                        text: "Rekap Raport",
                        url: "pages/rekapraport.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9008",
                text: "USBN",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90081",
                        text: "Daftar Peserta USBN",
                        icon: "fa fa-circle-o",
                        url: "pages/pesertaUN.php",
                        targetType: "iframe-tab"
                    },
					{
                        id: "90082",
                        text: "Cek Nilai Raport",
                        icon: "fa fa-circle-o",
                        url: "pages/raportUN.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90083",
                        text: "Latihan USBN",
                        url: "pages/tryout.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90084",
                        text: "Hasil USBN",
                        url: "pages/usbn.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            }
        ];
        $('.sidebar-menu').sidebarMenu({data: menus});

        // 动态创建菜单后，可以重新计算 SlimScroll
        // $.AdminLTE.layout.fixSidebar();

        /*if ($.AdminLTE.options.sidebarSlimScroll) {
            if (typeof $.fn.slimScroll != 'undefined') {
                //Destroy if it exists
                var $sidebar = $(".sidebar");
                $sidebar.slimScroll({destroy: true}).height("auto");
                //Add slimscroll
                $sidebar.slimscroll({
                    height: ($(window).height() - $(".main-header").height()) + "px",
                    color: "rgba(0,0,0,0.2)",
                    size: "3px"
                });
            }
        }*/

    });