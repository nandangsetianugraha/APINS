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
                children: [
                    {
						id: "11008",
						text: "Setting",
						icon: "fa fa-gear",
						url: "pages/setting.php",
						targetType: "iframe-tab"
					},
					{
						id: "9000",
						text: "Blog",
						icon: "fa fa-pencil",
						url: "pages/blog.php",
						targetType: "iframe-tab"
					}
                ]
            },
			{
                id: "10108",
                text: "Tabungan",
                icon: "fa fa-money",
                children: [
                    {
						id: "11108",
						text: "Nasabah",
						icon: "fa fa-user",
						url: "pages/nasabah.php",
						targetType: "iframe-tab"
					},
					{
						id: "9100",
						text: "Tabungan",
						icon: "fa fa-money",
						url: "pages/tabungan.php",
						targetType: "iframe-tab"
					}
                ]
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
                        text: "ID Absensi",
                        url: "pages/idAbsensi.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "91013",
                        text: "Absensi Pegawai",
                        url: "pages/absensipegawai.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    },
                    {
                        id: "91014",
                        text: "Rekap Absensi Pegawai",
                        url: "pages/rekapabsen.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9002",
                text: "Pengajian",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90021",
                        text: "Gaji Pokok",
                        icon: "fa fa-circle-o",
                        url: "pages/tunjangan.php",
                        targetType: "iframe-tab"
                    },
					{
                        id: "90022",
                        text: "Gaji Bulanan",
                        icon: "fa fa-circle-o",
                        url: "pages/gajibulanan.php",
                        targetType: "iframe-tab"
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