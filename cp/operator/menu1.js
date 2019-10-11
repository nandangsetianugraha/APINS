   /**
     * 本地搜索菜单
     */
    function search_menu() {
        //要搜索的值
        var text = $('input[name=q]').val();

        var $ul = $('.sidebar-menu');
        $ul.find("a.nav-link").each(function () {
            var $a = $(this).css("border", "");

            //判断是否含有要搜索的字符串
            if ($a.children("span.menu-text").text().indexOf(text) >= 0) {

                //如果a标签的父级是隐藏的就展开
                $ul = $a.parents("ul");

                if ($ul.is(":hidden")) {
                    $a.parents("ul").prev().click();
                }

                //点击该菜单
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
                id: "10008",
                text: "Beranda",
                icon: "fa fa-home",
                url: "pages/home.php",
                targetType: "iframe-tab"
            },
            {
                id: "9000",
                text: "Blog",
                icon: "fa fa-pencil",
                url: "pages/blog.php",
                targetType: "iframe-tab"
            },
            {
                id: "9001",
                text: "Peserta Didik",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90013",
                        text: "Rombel",
                        icon: "fa fa-circle-o",
                        url: "pages/rombel.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90011",
                        text: "Siswa",
                        icon: "fa fa-circle-o",
                        url: "pages/siswa.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90012",
                        text: "Absensi",
                        url: "pages/absensi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90014",
                        text: "SKKB",
                        url: "pages/skkb.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9101",
                text: "PTK",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "91011",
                        text: "PTK",
                        icon: "fa fa-circle-o",
                        url: "pages/ptk.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "91012",
                        text: "Pengajuan Cuti",
                        url: "pages/suratcuti.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9002",
                text: "Administrasi K13",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90021",
                        text: "Tema",
                        icon: "fa fa-circle-o",
                        url: "pages/tema.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90022",
                        text: "Kompetensi Dasar",
                        url: "pages/kompetensi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90023",
                        text: "Pemetaan KD",
                        url: "pages/pemetaan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "90024",
                        text: "KKM",
                        url: "pages/kkm.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9003",
                text: "Penilaian Sikap",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90031",
                        text: "Sikap Spiritual",
                        icon: "fa fa-circle-o",
                        url: "pages/spiritual.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90032",
                        text: "Sikap Sosial",
                        url: "pages/sosial.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9004",
                text: "Penilaian Harian",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90041",
                        text: "Pengetahuan",
                        icon: "fa fa-circle-o",
                        url: "pages/pengetahuan.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90042",
                        text: "Ketrampilan",
                        url: "pages/ketrampilan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9005",
                text: "Penilaian Semester",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90051",
                        text: "Tengah Semester",
                        icon: "fa fa-circle-o",
                        url: "pages/pts.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90052",
                        text: "Akhir Semester",
                        url: "pages/pas.php",
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
                    },
                    {
                        id: "90073",
                        text: "Form F1",
                        url: "pages/formF1.php",
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