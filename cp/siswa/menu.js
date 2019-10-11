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
                id: "10009",
                text: "Profil",
                icon: "fa fa-user",
                url: "pages/profil.php",
                targetType: "iframe-tab"
            },
			{
                id: "11118",
                text: "Tabungan",
                icon: "fa fa-money",
                url: "pages/tabungan.php",
                targetType: "iframe-tab"
            },
			{
                id: "9111",
                text: "Nilai Sikap",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90111",
                        text: "Spiritual",
                        icon: "fa fa-circle-o",
                        url: "pages/spiritual.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90112",
                        text: "Sosial",
                        url: "pages/sosial.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9001",
                text: "Nilai Harian",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90011",
                        text: "Pengetahuan",
                        icon: "fa fa-circle-o",
                        url: "pages/pengetahuan.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "90012",
                        text: "Ketrampilan",
                        url: "pages/ketrampilan.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9101",
                text: "Nilai Semester",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "91011",
                        text: "Tengah Semester",
                        icon: "fa fa-circle-o",
                        url: "pages/pts.php",
                        targetType: "iframe-tab"
                    },
                    {
                        id: "91012",
                        text: "Akhir Semester",
                        url: "pages/pas.php",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o"
                    }
                ]
            },
			{
                id: "9002",
                text: "Raport",
                icon: "fa fa-laptop",
                children: [
                    {
                        id: "90022",
                        text: "Nilai Raport",
                        icon: "fa fa-circle-o",
                        url: "pages/raport.php",
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