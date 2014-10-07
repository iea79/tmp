
Linked applications
Bitbucket

    Dashboard
    Teams
    Repositories
    Create

    owner/repository
    Help
    Logged in as allawitte

Commits
Alla Klimova committed c2bf759 17 hours ago
Approve

Top menu is ready, plugins conflicts are handled

Participants

        allawitte 

Parent commits
    04abc3c 
Raw commit
    View raw commit 
Watch
    Stop watching 

Comments (0)

Files changed (4)

    +220 -96
    src/DaVinci/TaxiBundle/Resources/public/css/styles.css
    +3 -943
    src/DaVinci/TaxiBundle/Resources/public/js/all.js
    +940 -0
    src/DaVinci/TaxiBundle/Resources/public/js/datarange.js
    +32 -26
    src/DaVinci/TaxiBundle/Resources/views/base.html.twig

Side-by-side diff View file
src/DaVinci/TaxiBundle/Resources/public/css/styles.css

 			background:#fff;

 			

 		}

-		.header-wrapper .header-top .header-top-in .logo {

-			float:left;

-			padding:2px 40px 2px 0;

-			background:#528ed3;

-			

-		}

-		

-			.header-wrapper .header-top .header-top-in  .topmenu-left {

-				background: url(../images/shashki-left-top.png) left center no-repeat #fff;

-				background-size:93px 48px;

-				float:left;

-				padding:9px 0 7px 6%;

-				max-width:600px;

-				

+			.header-top .header-top-in  .topmenu {

+				display:table;

+				width:100%;

 			}

-				.header-wrapper .header-top .header-top-in  .topmenu-left ul {

-					margin:0;

-				}

-				.header-wrapper .header-top .header-top-in  .topmenu-left  ul li {

-					font-size:18px;

-					font-weight:bold;

-					border-left:1px solid #d1d1d1;

-					color:#3d3d3d;

-					margin-left:0;

-					

-				}

-				.header-wrapper .header-top .header-top-in  .topmenu-left  ul li.nest {

-					padding-left:14px;

+				.header-top .header-top-in  .topmenu ul {

+					display:table-row;

+					list-style:none;

 				}

-					.header-wrapper .header-top .header-top-in  .topmenu-left  ul li.nest span {

-						padding:6px 0;

+					.header-top .header-top-in  .topmenu ul li {

+						display:table-cell;

+						vertical-align:middle;

 					}

-				.header-wrapper .header-top .header-top-in  .topmenu-left  ul li:first-child {

-					border:none;

-				}

-					.header-wrapper .header-top .header-top-in  .topmenu-left  ul li .text-item {

+						.header-top .header-top-in  .topmenu ul .nest {

+							text-align:center;

+							letter-spacing: 0;

+							font-size:0;

+							

+						}

+							.header-top .header-top-in  .topmenu ul .nest .nest-item {

+								padding:2px 0;

+							}

+							.header-top .header-top-in  .topmenu ul .nest span {

+								font-size:18px;

+								font-weight:bold;

+								color:#3d3d3d;

+								margin:0 5px;

+							}

+						.header-top .header-top-in  .topmenu ul  .empty-middle {

+							width:4%; 

+						}

+						.header-top .header-top-in  .topmenu ul li:first-child {

+							background-color:#528ed3;

+							width:15%;

+						}

+						.header-top .header-top-in  .topmenu ul li:first-child img {

+							margin-left:10px;

+						}

+							.header-top .header-top-in  .topmenu ul li:first-child a {

+								padding:0;

+							}

+						.header-top .header-top-in  .topmenu ul li:nth-child(2) {

+							background: url(../images/shashki-left-top.png) left top no-repeat;

+							width:10%;

+						}

+						.header-top .header-top-in  .topmenu ul li:last-child {

+							width:13.5%;

+							margin:0;

+							text-align:center;

+						}

+							.header-top .header-top-in  .topmenu ul li:last-child a {

+								padding:0;

+							}

+						.header-top .header-top-in  .topmenu ul li:nth-child(5) {

+							text-align:right;

+							width:20.5%;

+						}

+						

+					

+						

+						.header-top .header-top-in  .topmenu ul li .texst-item {

+							font-size:18px;

+							font-weight:bold;

+							display:inline-block;

+							border-right:1px solid #d1d1d1;

+							text-align:center;

+							padding:2px 6%;

+							color:#3d3d3d;

+						}

+					.header-wrapper .header-top .header-top-in  .topmenu  ul li .text-item {

 						color:#3d3d3d;

 						padding:6px 14px;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-left  ul li .figur-item {

-						color:#fff;

-						font-size:20px;

-						border-radius:5px;

-						height:22px;

-						width:22px;

-						text-align:center;

+					.header-wrapper .header-top .header-top-in  .topmenu  ul li .figur-item {

+						border-radius: 3px;

+						color: #fff;

+						font-size: 17px;

+						height: 20px;

+						padding: 3px 5px;

+						text-align: center;

+						width: 16px;

+						margin:0;

+					}

+					.header-top .header-top-in  .topmenu ul li a:nth-child(3) {

+						margin-left:6%;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-left  ul li a.uk-button-danger:hover {

+					.header-wrapper .header-top .header-top-in  .topmenu  ul li a.uk-button-danger:hover {

 						background-color: #e4354f;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-left  ul li a.uk-button-primary:hover {

+					.header-wrapper .header-top .header-top-in  .topmenu  ul li a.uk-button-primary:hover {

 						background-color: #35b3ee;

 					}

-			.header-wrapper .header-top .header-top-in  .topmenu-right {

-				float:right;

-				text-align:right;

-				font-size:16px;

-			}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .book-store {

+			

+			.header-wrapper .header-top .header-top-in  .topmenu .book-store {

 				display:inline-block;

-				margin-right:-34px;

-				

+				width:100%;

+				font-size:0;

+				display:table;

 			}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .book-store a {

+			.header-wrapper .header-top .header-top-in  .topmenu .book-store a {

 				display:inline-block;

-				padding:14px 18px;

-				margin-left:-5px;

+				

+				font-family:calibri;

 				text-transform:uppercase;

-

+				width:50%;

+				box-sizing: border-box;

+				text-align:center;

+				font-size:16px;

 			}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .book-store .thumb {

+				.header-wrapper .header-top .header-top-in  .topmenu .book-store a:first-child {

+					padding:14px 21px 14px 15px;

+				}

+				.header-wrapper .header-top .header-top-in  .topmenu .book-store a:nth-child(2) {

+					padding:14px 15px 14px 21px;

+				}

+			.header-wrapper .header-top .header-top-in  .topmenu .book-store .thumb {

 				background-color: #fff;

 				border-radius: 18px;

 				color: #528ed3;

 				display: inline-block;

-				font-size: 23px;

-				padding: 1px 3px;

-				position: relative;

-				right: 108px;

-				top:3px;

+				font-size: 24px;

+				padding: 4px 7px;

+				position: absolute;

+				right: 43%;

+				top:20%;

 			}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .nonautorized {

+			.header-wrapper .header-top .header-top-in  .topmenu .nonautorized {

 				color:#ff4d61;

 			}

-				.header-wrapper .header-top .header-top-in  .topmenu-right .nonautorized a {

+				.header-wrapper .header-top .header-top-in  .topmenu .nonautorized a {

 					color:#ff4d61;

 				}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .autorized {

+			.header-wrapper .header-top .header-top-in  .topmenu .autorized {

 				color:#3c3d45;

 				line-height:0.5;

 				

 			}

-			.header-wrapper .header-top .header-top-in  .topmenu-right .autorized:hover {

+			.header-wrapper .header-top .header-top-in  .topmenu .autorized:hover {

 				text-decoration:none;

 			}

-				.header-wrapper .header-top .header-top-in  .topmenu-right .autorized .ownship {

+				.header-wrapper .header-top .header-top-in  .topmenu .autorized .ownship {

 					color:#ff4d61;

 					font-size:12px;

 					padding:0 10px 0 0;

 			}

-				.header-wrapper .header-top .header-top-in  .topmenu-right .autorized .caption {

+				.header-wrapper .header-top .header-top-in  .topmenu .autorized .caption {

 					position:relative;

 					font-size:16px;

 					top:-6px;

 				}

 			/*====================== styles of drop down menu =======================================*/

-			.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown {

+			.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown {

 				text-align:left;

 				vertical-align:top;

 				border:1px solid #d0d0d0;

 				width:600px;

 				right:0;

 			}

-				.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown div {

+				.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown div {

 					float:left;

 					overflow:hidden;

 					font-size:16px;

 					

 				}

-					.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown div .uk-nav {

+					.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown div .uk-nav {

 						margin:0;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop {

+					.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop {

 						min-width:200px;

 						margin:0 0 0 15px;

 						border-left:1px solid #d0d0d0;

 						padding:0 0 0 15px;

 						height:120px;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myoffice-drop {

+					.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myoffice-drop {

 						border-left:1px solid #d0d0d0;

 						padding:0 0 0 15px;

 						height:120px;

 					}

-					.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord {

+					.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord {

 						margin:15px 0 0 0;

 					}

-						.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord  li{

+						.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord  li{

 						padding-left:25px;

 					}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord  li a:hover {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop .menu-bord  li a:hover {

 								color:#fff;

 								background-color:#528ed3;

 								text-decoration:none;

 							}

-						.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop-top {

+						.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop-top {

 							float:none;

 							clear:both;

 							width:100%;

 							

 						}

 							

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop-top .img {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop-top .img {

 								float:left;

 								width:62px;

 								height:60px;

 								border:1px solid #d0d0d0;

 								

 						}	

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop-top .img img {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop-top .img img {

 								width:59px;

 								height:58px;

 							}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop-top .uk-nav {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop-top .uk-nav {

 								margin:0 0 0 15px;

 								display:inline-block;

 							}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myid-drop-top .clientid {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myid-drop-top .clientid {

 								float:none;

 								clear:both;

 							}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .myoffice-drop .uk-button {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .myoffice-drop .uk-button {

 								margin-top:15px;

 								font-size:16px;

 							}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown .uk-nav-header {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown .uk-nav-header {

 													font-size: 16px;

 													text-transform: capitalize;

 													color: #3c3d45;

 													padding-left: 0;

 													}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a {

 								color:#528ed3;

 								padding:5px 0;

 							}

-							.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a:hover {

+							.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a:hover {

 								color:#fff;

 								}

-								.header-wrapper .header-top .header-top-in  .topmenu-right .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a i {

+								.header-wrapper .header-top .header-top-in  .topmenu .uk-button-dropdown .uk-dropdown  .myaccount-drop ul li a i {

 									width:15px;

 								}

 			/* ====================  the bottom part of header with breadcrumbs and languages ============================ */

     }

     

 @media only screen and (max-width:480px) {

+	.header-wrapper .header-top .header-top-in .logo, .header-top-in .uk-navbar-toggle {

+		display:block;

+		top:0;

+		color:#528ed3;

+		position:absolute;

+		right:0;

+	}

+	

+.header-top .header-top-in .topmenu ul li:nth-child(2) {

+	display:block!important;

+	width:78px;

+	height:48px;

+	margin:0;

+}

+.header-top .header-top-in .topmenu ul li:nth-child(3), .header-top .header-top-in .topmenu ul li:nth-child(4),

+ .header-top .header-top-in .topmenu ul li:nth-child(5), .header-top .header-top-in .topmenu ul li:nth-child(6) {

+	display:none;

+}

     .whitebg .uk-table td p button  {

    	 padding:0 10px;

    	 font-size:14px;

 

 /* Mobile */

 /*===  for top menu   ======*/

+@media only screen and (max-width: 850px) { 

+	.header-top .header-top-in .topmenu ul li:nth-child(2) {

+		display:none;

+		}

+

+	.header-top .header-top-in .topmenu ul .empty-middle {

+		display:none;

+		}

+		

+.header-top .header-top-in .topmenu ul li:last-child {

+	width:133px;

+}

+

+.header-top .header-top-in .topmenu ul li:first-child {

+	width:123px;

+}

+

+.header-top .header-top-in .topmenu ul li:nth-child(5) {

+	width:auto;

+	text-align:right;

+}

+

+

+

+}

 

  @media only screen and (max-width: 800px) {

 	

 	.order-details .adapt-left .overinput {

 		width:60%;

 	}

+	

+	.header-wrapper .header-top .header-top-in .topmenu ul li .figur-item {

+		display:none;

+	}

+	

+	.header-wrapper .header-top .header-top-in .topmenu .book-store .thumb {

+		display:none;

+	}

+	

+	.header-top .header-top-in .topmenu ul li .texst-item {

+		font-weight:normal;

+	}

+	

+	.header-top .header-top-in .topmenu ul .nest span {

+		font-weight:normal;

+	}

+	

 }

 @media only screen and (max-width: 600px) {

-	.header-wrapper .header-top .header-top-in .logo, .header-top-in .uk-navbar-toggle {

-		display:block;

+	

+	.header-wrapper .header-top .header-top-in .topmenu .book-store {

+		font-size:14px;

+		width:62px;

+		display:inline-block;

+		

 	}

-	.header-wrapper .header-top .header-top-in .topmenu-left ul.uk-subnav,  .header-wrapper .header-top .header-top-in .topmenu-right {

-		display:none;

+	.header-wrapper .header-top .header-top-in .topmenu .book-store a {

+		width:62px;

+		padding:2px 0!important;

 	}

+	

+	

+	

+	.header-top .header-top-in .topmenu ul li:last-child  {

+		width:20%!important;

+	}

+		.header-top .header-top-in .topmenu ul li:last-child .uk-button {

+			padding:0;

+		}

 		

-			.header-wrapper .header-top .header-top-in .topmenu-left {

-				width:93px;

-				height:32px;

-			}

+	

+	

+	.header-top .header-top-in .topmenu ul .nest span {

+		

+		margin:0;

+		}

 }

 @media only screen and (min-width:761px) {

 .home .destination {

 	.pinned table th, .pinned table td { white-space: nowrap; }

 	.pinned td:last-child { border-bottom: 0; }

 	

-	div.table-wrapper { position: relative; margin-bottom: 20px; overflow: hidden; border-right: 1px solid #ccc; }

+	div.table-wrapper { position: relative; margin-bottom: 20px; overflow: hidden; border-right: 1px solid #ccc; } 

 	div.table-wrapper div.scrollable {

 		margin-right: 20%; 

 	}

 	}

 	div.table-wrapper div.scrollable { overflow: scroll; overflow-y: hidden; }	

 	

-	table.responsive td, table.responsive th { position: relative; white-space: nowrap; overflow: hidden; }

-	table.responsive th:last-child, table.responsive td:last-child, table.responsive td:last-child, table.responsive.pinned td { display: none; }

+	/*table.responsive td, table.responsive th { position: relative; white-space: nowrap; overflow: hidden; } */

+	table.responsive tbody tr > th:last-child, table.responsive tbody tr  > td:last-child, table.responsive.pinned tbody tr > td { display: none; }

 }

 

 

 }

 div.datepicker table {

 	border-collapse:collapse;

+	

+}

+div.datepicker table  td{

+	display:table-cell!important

 }

 div.datepicker a {

 	color: #666;

 	height: 0px;

 	overflow: hidden;

 	width: 400px;

-	background: #B9B9B9;

+	

 }

 #widgetCalendar .datepicker {

 	position: absolute;

Side-by-side diff View file
src/DaVinci/TaxiBundle/Resources/public/js/all.js

 

         tr.each(function (index) {

             var self = $(this),

-                    tx = self.find('th, td');

+                    tx = self.find('td');

 

             tx.each(function () {

                 var height = $(this).outerHeight(true);

                 heights[index] = heights[index] || 0;

-                if (height > heights[index])

+                if (height > heights[index] && index>1)

                     heights[index] = height;

             });

 

 

         tr_copy.each(function (index) {

             $(this).height(heights[index]);

-        });

+        }); 

     }

     ;

 

   });

 // Стилизация select с цветами машин //////////////////////////

 

-// Datapicker

-/**

- *

- * Date picker

- * Author: Stefan Petre www.eyecon.ro

- * 

- * Dual licensed under the MIT and GPL licenses

- * 

- */

- (function($){

-	var EYE = window.EYE = function() {

-		var _registered = {

-			init: []

-		};

-		return {

-			init: function() {

-				$.each(_registered.init, function(nr, fn){

-					fn.call();

-				});

-			},

-			extend: function(prop) {

-				for (var i in prop) {

-					if (prop[i] != undefined) {

-						this[i] = prop[i];

-					}

-				}

-			},

-			register: function(fn, type) {

-				if (!_registered[type]) {

-					_registered[type] = [];

-				}

-				_registered[type].push(fn);

-			}

-		};

-	}();

-	$(EYE.init);

-})(jQuery);

-

-

-//The main Datapicker  

-(function ($) {

-	var DatePicker = function () {

-		var	ids = {},

-			views = {

-				years: 'datepickerViewYears',

-				moths: 'datepickerViewMonths',

-				days: 'datepickerViewDays'

-			},

-			tpl = {

-				wrapper: '<div class="datepicker"><div class="datepickerContainer"><table cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></div></div>',

-				head: [

-					'<td>',

-					'<table cellspacing="0" cellpadding="0">',

-						'<thead>',

-							'<tr>',

-								'<th class="datepickerGoPrev"><a href="#"><span><%=prev%></span></a></th>',

-								'<th colspan="5" class="datepickerMonth"><a href="#"><span></span></a></th>',

-								'<th class="datepickerGoNext"><a href="#"><span><%=next%></span></a></th>',

-							'</tr>',

-							'<tr class="datepickerDoW">',

-								'<th><span><%=day1%></span></th>',

-								'<th><span><%=day2%></span></th>',

-								'<th><span><%=day3%></span></th>',

-								'<th><span><%=day4%></span></th>',

-								'<th><span><%=day5%></span></th>',

-								'<th><span><%=day6%></span></th>',

-								'<th><span><%=day7%></span></th>',

-							'</tr>',

-						'</thead>',

-					'</table></td>'

-				],

-				space : '<td class="datepickerSpace"><div></div></td>',

-				days: [

-					'<tbody class="datepickerDays">',

-						'<tr>',

-							'<td class="<%=weeks[0].days[0].classname%>"><a href="#"><span><%=weeks[0].days[0].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[1].classname%>"><a href="#"><span><%=weeks[0].days[1].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[2].classname%>"><a href="#"><span><%=weeks[0].days[2].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[3].classname%>"><a href="#"><span><%=weeks[0].days[3].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[4].classname%>"><a href="#"><span><%=weeks[0].days[4].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[5].classname%>"><a href="#"><span><%=weeks[0].days[5].text%></span></a></td>',

-							'<td class="<%=weeks[0].days[6].classname%>"><a href="#"><span><%=weeks[0].days[6].text%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td class="<%=weeks[1].days[0].classname%>"><a href="#"><span><%=weeks[1].days[0].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[1].classname%>"><a href="#"><span><%=weeks[1].days[1].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[2].classname%>"><a href="#"><span><%=weeks[1].days[2].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[3].classname%>"><a href="#"><span><%=weeks[1].days[3].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[4].classname%>"><a href="#"><span><%=weeks[1].days[4].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[5].classname%>"><a href="#"><span><%=weeks[1].days[5].text%></span></a></td>',

-							'<td class="<%=weeks[1].days[6].classname%>"><a href="#"><span><%=weeks[1].days[6].text%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td class="<%=weeks[2].days[0].classname%>"><a href="#"><span><%=weeks[2].days[0].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[1].classname%>"><a href="#"><span><%=weeks[2].days[1].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[2].classname%>"><a href="#"><span><%=weeks[2].days[2].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[3].classname%>"><a href="#"><span><%=weeks[2].days[3].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[4].classname%>"><a href="#"><span><%=weeks[2].days[4].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[5].classname%>"><a href="#"><span><%=weeks[2].days[5].text%></span></a></td>',

-							'<td class="<%=weeks[2].days[6].classname%>"><a href="#"><span><%=weeks[2].days[6].text%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td class="<%=weeks[3].days[0].classname%>"><a href="#"><span><%=weeks[3].days[0].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[1].classname%>"><a href="#"><span><%=weeks[3].days[1].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[2].classname%>"><a href="#"><span><%=weeks[3].days[2].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[3].classname%>"><a href="#"><span><%=weeks[3].days[3].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[4].classname%>"><a href="#"><span><%=weeks[3].days[4].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[5].classname%>"><a href="#"><span><%=weeks[3].days[5].text%></span></a></td>',

-							'<td class="<%=weeks[3].days[6].classname%>"><a href="#"><span><%=weeks[3].days[6].text%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td class="<%=weeks[4].days[0].classname%>"><a href="#"><span><%=weeks[4].days[0].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[1].classname%>"><a href="#"><span><%=weeks[4].days[1].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[2].classname%>"><a href="#"><span><%=weeks[4].days[2].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[3].classname%>"><a href="#"><span><%=weeks[4].days[3].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[4].classname%>"><a href="#"><span><%=weeks[4].days[4].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[5].classname%>"><a href="#"><span><%=weeks[4].days[5].text%></span></a></td>',

-							'<td class="<%=weeks[4].days[6].classname%>"><a href="#"><span><%=weeks[4].days[6].text%></span></a></td>',

-						'</tr>',

-					'</tbody>'

-				],

-				months: [

-					'<tbody class="<%=className%>">',

-						'<tr>',

-							'<td colspan="2"><a href="#"><span><%=data[0]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[1]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[2]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[3]%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td colspan="2"><a href="#"><span><%=data[4]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[5]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[6]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[7]%></span></a></td>',

-						'</tr>',

-						'<tr>',

-							'<td colspan="2"><a href="#"><span><%=data[8]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[9]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[10]%></span></a></td>',

-							'<td colspan="2"><a href="#"><span><%=data[11]%></span></a></td>',

-						'</tr>',

-					'</tbody>'

-				]

-			},

-			defaults = {

-				flat: false,

-				starts: 1,

-				prev: '&#9664;',

-				next: '&#9654;',

-				lastSel: false,

-				mode: 'single',

-				view: 'days',

-				calendars: 1,

-				format: 'Y-m-d',

-				position: 'bottom',

-				eventName: 'click',

-				onRender: function(){return {};},

-				onChange: function(){return true;},

-				onShow: function(){return true;},

-				onBeforeShow: function(){return true;},

-				onHide: function(){return true;},

-				locale: {

-					days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],

-					daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],

-					daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],

-					months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],

-					/*months: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"], */

-					monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

-					weekMin: 'wk'

-				}

-			},

-			fill = function(el) {

-				var options = $(el).data('datepicker');

-				var cal = $(el);

-				var currentCal = Math.floor(options.calendars/2), date, data, dow, month, cnt = 0, week, days, indic, indic2, html, tblCal;

-				cal.find('td>table tbody').remove();

-				for (var i = 0; i < options.calendars; i++) {

-					date = new Date(options.current);

-					date.addMonths(-currentCal + i);

-					tblCal = cal.find('table').eq(i+1);

-					switch (tblCal[0].className) {

-						case 'datepickerViewDays':

-							dow = formatDate(date, 'B, Y');

-							break;

-						case 'datepickerViewMonths':

-							dow = date.getFullYear();

-							break;

-						case 'datepickerViewYears':

-							dow = (date.getFullYear()-6) + ' - ' + (date.getFullYear()+5);

-							break;

-					} 

-					tblCal.find('thead tr:first th:eq(1) span').text(dow);

-					dow = date.getFullYear()-6;

-					data = {

-						data: [],

-						className: 'datepickerYears'

-					}

-					for ( var j = 0; j < 12; j++) {

-						data.data.push(dow + j);

-					}

-					html = tmpl(tpl.months.join(''), data);

-					date.setDate(1);

-					data = {weeks:[], test: 10};

-					month = date.getMonth();

-					var dow = (date.getDay() - options.starts) % 7;

-					date.addDays(-(dow + (dow < 0 ? 7 : 0)));

-					week = -1;

-					cnt = 0;

-					while (cnt < 42) {

-						indic = parseInt(cnt/7,10);

-						indic2 = cnt%7;

-						if (!data.weeks[indic]) {

-							week = date.getWeekNumber();

-							data.weeks[indic] = {

-								week: week,

-								days: []

-							};

-						}

-						data.weeks[indic].days[indic2] = {

-							text: date.getDate(),

-							classname: []

-						};

-						if (month != date.getMonth()) {

-							data.weeks[indic].days[indic2].classname.push('datepickerNotInMonth');

-						}

-						if (date.getDay() == 0) {

-							data.weeks[indic].days[indic2].classname.push('datepickerSunday');

-						}

-						if (date.getDay() == 6) {

-							data.weeks[indic].days[indic2].classname.push('datepickerSaturday');

-						}

-						var fromUser = options.onRender(date);

-						var val = date.valueOf();

-						if (fromUser.selected || options.date == val || $.inArray(val, options.date) > -1 || (options.mode == 'range' && val >= options.date[0] && val <= options.date[1])) {

-							data.weeks[indic].days[indic2].classname.push('datepickerSelected');

-						}

-						if (fromUser.disabled) {

-							data.weeks[indic].days[indic2].classname.push('datepickerDisabled');

-						}

-						if (fromUser.className) {

-							data.weeks[indic].days[indic2].classname.push(fromUser.className);

-						}

-						data.weeks[indic].days[indic2].classname = data.weeks[indic].days[indic2].classname.join(' ');

-						cnt++;

-						date.addDays(1);

-					}

-					html = tmpl(tpl.days.join(''), data) + html;

-					data = {

-						data: options.locale.monthsShort,

-						className: 'datepickerMonths'

-					};

-					html = tmpl(tpl.months.join(''), data) + html;

-					tblCal.append(html);

-				}

-			},

-			parseDate = function (date, format) {

-				if (date.constructor == Date) {

-					return new Date(date);

-				}

-				var parts = date.split(/\W+/);

-				var against = format.split(/\W+/), d, m, y, h, min, now = new Date();

-				for (var i = 0; i < parts.length; i++) {

-					switch (against[i]) {

-						case 'd':

-						case 'e':

-							d = parseInt(parts[i],10);

-							break;

-						case 'm':

-							m = parseInt(parts[i], 10)-1;

-							break;

-						case 'Y':

-						case 'y':

-							y = parseInt(parts[i], 10);

-							y += y > 100 ? 0 : (y < 29 ? 2000 : 1900);

-							break;

-						case 'H':

-						case 'I':

-						case 'k':

-						case 'l':

-							h = parseInt(parts[i], 10);

-							break;

-						case 'P':

-						case 'p':

-							if (/pm/i.test(parts[i]) && h < 12) {

-								h += 12;

-							} else if (/am/i.test(parts[i]) && h >= 12) {

-								h -= 12;

-							}

-							break;

-						case 'M':

-							min = parseInt(parts[i], 10);

-							break;

-					}

-				}

-				return new Date(

-					y === undefined ? now.getFullYear() : y,

-					m === undefined ? now.getMonth() : m,

-					d === undefined ? now.getDate() : d,

-					h === undefined ? now.getHours() : h,

-					min === undefined ? now.getMinutes() : min,

-					0

-				);

-			},

-			formatDate = function(date, format) {

-				var m = date.getMonth();

-				var d = date.getDate();

-				var y = date.getFullYear();

-				var wn = date.getWeekNumber();

-				var w = date.getDay();

-				var s = {};

-				var hr = date.getHours();

-				var pm = (hr >= 12);

-				var ir = (pm) ? (hr - 12) : hr;

-				var dy = date.getDayOfYear();

-				if (ir == 0) {

-					ir = 12;

-				}

-				var min = date.getMinutes();

-				var sec = date.getSeconds();

-				var parts = format.split(''), part;

-				for ( var i = 0; i < parts.length; i++ ) {

-					part = parts[i];

-					switch (parts[i]) {

-						case 'a':

-							part = date.getDayName();

-							break;

-						case 'A':

-							part = date.getDayName(true);

-							break;

-						case 'b':

-							part = date.getMonthName();

-							break;

-						case 'B':

-							part = date.getMonthName(true);

-							break;

-						case 'C':

-							part = 1 + Math.floor(y / 100);

-							break;

-						case 'd':

-							part = (d < 10) ? ("0" + d) : d;

-							break;

-						case 'e':

-							part = d;

-							break;

-						case 'H':

-							part = (hr < 10) ? ("0" + hr) : hr;

-							break;

-						case 'I':

-							part = (ir < 10) ? ("0" + ir) : ir;

-							break;

-						case 'j':

-							part = (dy < 100) ? ((dy < 10) ? ("00" + dy) : ("0" + dy)) : dy;

-							break;

-						case 'k':

-							part = hr;

-							break;

-						case 'l':

-							part = ir;

-							break;

-						case 'm':

-							part = (m < 9) ? ("0" + (1+m)) : (1+m);

-							break;

-						case 'M':

-							part = (min < 10) ? ("0" + min) : min;

-							break;

-						case 'p':

-						case 'P':

-							part = pm ? "PM" : "AM";

-							break;

-						case 's':

-							part = Math.floor(date.getTime() / 1000);

-							break;

-						case 'S':

-							part = (sec < 10) ? ("0" + sec) : sec;

-							break;

-						case 'u':

-							part = w + 1;

-							break;

-						case 'w':

-							part = w;

-							break;

-						case 'y':

-							part = ('' + y).substr(2, 2);

-							break;

-						case 'Y':

-							part = y;

-							break;

-					}

-					parts[i] = part;

-				}

-				return parts.join('');

-			},

-			extendDate = function(options) {

-				if (Date.prototype.tempDate) {

-					return;

-				}

-				Date.prototype.tempDate = null;

-				Date.prototype.months = options.months;

-				Date.prototype.monthsShort = options.monthsShort;

-				Date.prototype.days = options.days;

-				Date.prototype.daysShort = options.daysShort;

-				Date.prototype.getMonthName = function(fullName) {

-					return this[fullName ? 'months' : 'monthsShort'][this.getMonth()];

-				};

-				Date.prototype.getDayName = function(fullName) {

-					return this[fullName ? 'days' : 'daysShort'][this.getDay()];

-				};

-				Date.prototype.addDays = function (n) {

-					this.setDate(this.getDate() + n);

-					this.tempDate = this.getDate();

-				};

-				Date.prototype.addMonths = function (n) {

-					if (this.tempDate == null) {

-						this.tempDate = this.getDate();

-					}

-					this.setDate(1);

-					this.setMonth(this.getMonth() + n);

-					this.setDate(Math.min(this.tempDate, this.getMaxDays()));

-				};

-				Date.prototype.addYears = function (n) {

-					if (this.tempDate == null) {

-						this.tempDate = this.getDate();

-					}

-					this.setDate(1);

-					this.setFullYear(this.getFullYear() + n);

-					this.setDate(Math.min(this.tempDate, this.getMaxDays()));

-				};

-				Date.prototype.getMaxDays = function() {

-					var tmpDate = new Date(Date.parse(this)),

-						d = 28, m;

-					m = tmpDate.getMonth();

-					d = 28;

-					while (tmpDate.getMonth() == m) {

-						d ++;

-						tmpDate.setDate(d);

-					}

-					return d - 1;

-				};

-				Date.prototype.getFirstDay = function() {

-					var tmpDate = new Date(Date.parse(this));

-					tmpDate.setDate(1);

-					return tmpDate.getDay();

-				};

-				Date.prototype.getWeekNumber = function() {

-					var tempDate = new Date(this);

-					tempDate.setDate(tempDate.getDate() - (tempDate.getDay() + 6) % 7 + 3);

-					var dms = tempDate.valueOf();

-					tempDate.setMonth(0);

-					tempDate.setDate(4);

-					return Math.round((dms - tempDate.valueOf()) / (604800000)) + 1;

-				};

-				Date.prototype.getDayOfYear = function() {

-					var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);

-					var then = new Date(this.getFullYear(), 0, 0, 0, 0, 0);

-					var time = now - then;

-					return Math.floor(time / 24*60*60*1000);

-				};

-			},

-			

-			click = function(ev) {

-				if ($(ev.target).is('span')) {

-					ev.target = ev.target.parentNode;

-				}

-				var el = $(ev.target);

-				if (el.is('a')) {

-					ev.target.blur();

-					if (el.hasClass('datepickerDisabled')) {

-						return false;

-					}

-					var options = $(this).data('datepicker');

-					var parentEl = el.parent();

-					var tblEl = parentEl.parent().parent().parent();

-					var tblIndex = $('table', this).index(tblEl.get(0)) - 1;

-					var tmp = new Date(options.current);

-					var changed = false;

-					var fillIt = false;

-					if (parentEl.is('th')) { 

-						if (parentEl.hasClass('datepickerWeek') && options.mode == 'range' && !parentEl.next().hasClass('datepickerDisabled')) {

-							var val = parseInt(parentEl.next().text(), 10);

-							tmp.addMonths(tblIndex - Math.floor(options.calendars/2));

-							if (parentEl.next().hasClass('datepickerNotInMonth')) {

-								tmp.addMonths(val > 15 ? -1 : 1);

-							}

-							tmp.setDate(val);

-							options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();

-							tmp.setHours(23,59,59,0);

-							tmp.addDays(6);

-							options.date[1] = tmp.valueOf();

-							fillIt = true;

-							changed = true;

-							options.lastSel = false;

-						} 

-						else if (parentEl.parent().parent().is('thead')) {

-							switch (tblEl.get(0).className) {

-								case 'datepickerViewDays':

-									options.current.addMonths(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);

-									break;

-								case 'datepickerViewMonths':

-									options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);

-									break;

-								case 'datepickerViewYears':

-									options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -12 : 12);

-									break;

-							}

-							fillIt = true;

-						}

-					} else if (parentEl.is('td') && !parentEl.hasClass('datepickerDisabled')) {

-						switch (tblEl.get(0).className) {

-							case 'datepickerViewMonths':

-								options.current.setMonth(tblEl.find('tbody.datepickerMonths td').index(parentEl));

-								options.current.setFullYear(parseInt(tblEl.find('thead th.datepickerMonth span').text(), 10));

-								options.current.addMonths(Math.floor(options.calendars/2) - tblIndex);

-								tblEl.get(0).className = 'datepickerViewDays';

-								break;

-							case 'datepickerViewYears':

-								options.current.setFullYear(parseInt(el.text(), 10));

-								tblEl.get(0).className = 'datepickerViewMonths';

-								break;

-							default:

-								var val = parseInt(el.text(), 10);

-								tmp.addMonths(tblIndex - Math.floor(options.calendars/2));

-								if (parentEl.hasClass('datepickerNotInMonth')) {

-									tmp.addMonths(val > 15 ? -1 : 1);

-								}

-								tmp.setDate(val);

-								switch (options.mode) {

-									case 'multiple':

-										val = (tmp.setHours(0,0,0,0)).valueOf();

-										if ($.inArray(val, options.date) > -1) {

-											$.each(options.date, function(nr, dat){

-												if (dat == val) {

-													options.date.splice(nr,1);

-													return false;

-												}

-											});

-										} else {

-											options.date.push(val);

-										}

-										break;

-									case 'range':

-										if (!options.lastSel) {

-											options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();

-										}

-										val = (tmp.setHours(23,59,59,0)).valueOf();

-										if (val < options.date[0]) {

-											options.date[1] = options.date[0] + 86399000;

-											options.date[0] = val - 86399000;

-										} else {

-											options.date[1] = val;

-										}

-										options.lastSel = !options.lastSel;

-										break;

-									default:

-										options.date = tmp.valueOf();

-										break;

-								}

-								break;

-						}

-						fillIt = true;

-						changed = true;

-					}

-					if (fillIt) {

-						fill(this);

-					}

-					if (changed) {

-						options.onChange.apply(this, prepareDate(options));

-					}

-				}

-				return false;

-			},

-			prepareDate = function (options) {

-				var tmp;

-				if (options.mode == 'single') {

-					tmp = new Date(options.date);

-					return [formatDate(tmp, options.format), tmp, options.el];

-				} else {

-					tmp = [[],[], options.el];

-					$.each(options.date, function(nr, val){

-						var date = new Date(val);

-						options.format = 'd/m/Y'

-						tmp[0].push(formatDate(date, options.format));

-						tmp[1].push(date);

-					});

-					return tmp;

-				}

-			},

-			getViewport = function () {

-				var m = document.compatMode == 'CSS1Compat';

-				return {

-					l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),

-					t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),

-					w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),

-					h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)

-				};

-			},

-			isChildOf = function(parentEl, el, container) {

-				if (parentEl == el) {

-					return true;

-				}

-				if (parentEl.contains) {

-					return parentEl.contains(el);

-				}

-				if ( parentEl.compareDocumentPosition ) {

-					return !!(parentEl.compareDocumentPosition(el) & 16);

-				}

-				var prEl = el.parentNode;

-				while(prEl && prEl != container) {

-					if (prEl == parentEl)

-						return true;

-					prEl = prEl.parentNode;

-				}

-				return false;

-			},

-			show = function (ev) {

-				var cal = $('#' + $(this).data('datepickerId'));

-				if (!cal.is(':visible')) {

-					var calEl = cal.get(0);

-					fill(calEl);

-					var options = cal.data('datepicker');

-					options.onBeforeShow.apply(this, [cal.get(0)]);

-					var pos = $(this).offset();

-					var viewPort = getViewport();

-					var top = pos.top;

-					var left = pos.left;

-					var oldDisplay = $.curCSS(calEl, 'display');

-					cal.css({

-						visibility: 'hidden',

-						display: 'block'

-					});

-					layout(calEl);

-					switch (options.position){

-						case 'top':

-							top -= calEl.offsetHeight;

-							break;

-						case 'left':

-							left -= calEl.offsetWidth;

-							break;

-						case 'right':

-							left += this.offsetWidth;

-							break;

-						case 'bottom':

-							top += this.offsetHeight;

-							break;

-					}

-					if (top + calEl.offsetHeight > viewPort.t + viewPort.h) {

-						top = pos.top  - calEl.offsetHeight;

-					}

-					if (top < viewPort.t) {

-						top = pos.top + this.offsetHeight + calEl.offsetHeight;

-					}

-					if (left + calEl.offsetWidth > viewPort.l + viewPort.w) {

-						left = pos.left - calEl.offsetWidth;

-					}

-					if (left < viewPort.l) {

-						left = pos.left + this.offsetWidth

-					}

-					cal.css({

-						visibility: 'visible',

-						display: 'block',

-						top: top + 'px',

-						left: left + 'px'

-					});

-					if (options.onShow.apply(this, [cal.get(0)]) != false) {

-						cal.show();

-					}

-					$(document).bind('mousedown', {cal: cal, trigger: this}, hide);

-				}

-				return false;

-			},

-			hide = function (ev) {

-				if (ev.target != ev.data.trigger && !isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {

-					if (ev.data.cal.data('datepicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {

-						ev.data.cal.hide();

-					}

-					$(document).unbind('mousedown', hide);

-				}

-			};

-		return {

-			init: function(options){

-				options = $.extend({}, defaults, options||{});

-				extendDate(options.locale);

-				options.calendars = Math.max(1, parseInt(options.calendars,10)||1);

-				options.mode = /single|multiple|range/.test(options.mode) ? options.mode : 'single';

-				return this.each(function(){

-					if (!$(this).data('datepicker')) {

-						options.el = this;

-						if (options.date.constructor == String) {

-							options.date = parseDate(options.date, options.format);

-							options.date.setHours(0,0,0,0);

-						}

-						if (options.mode != 'single') {

-							if (options.date.constructor != Array) {

-								options.date = [options.date.valueOf()];

-								if (options.mode == 'range') {

-									options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());

-								}

-							} else {

-								for (var i = 0; i < options.date.length; i++) {

-									options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();

-								}

-								if (options.mode == 'range') {

-									options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();

-								}

-							}

-						} else {

-							options.date = options.date.valueOf();

-						}

-						if (!options.current) {

-							options.current = new Date();

-						} else {

-							options.current = parseDate(options.current, options.format);

-						} 

-						options.current.setDate(1);

-						options.current.setHours(0,0,0,0);

-						var id = 'datepicker_' + parseInt(Math.random() * 1000), cnt;

-						options.id = id;

-						$(this).data('datepickerId', options.id);

-						var cal = $(tpl.wrapper).attr('id', id).bind('click', click).data('datepicker', options);

-						if (options.className) {

-							cal.addClass(options.className);

-						}

-						var html = '';

-						for (var i = 0; i < options.calendars; i++) {

-							cnt = options.starts;

-							if (i > 0) {

-								html += tpl.space;

-							}

-							html += tmpl(tpl.head.join(''), {

-									week: options.locale.weekMin,

-									prev: options.prev,

-									next: options.next,

-									day1: options.locale.daysMin[(cnt++)%7],

-									day2: options.locale.daysMin[(cnt++)%7],

-									day3: options.locale.daysMin[(cnt++)%7],

-									day4: options.locale.daysMin[(cnt++)%7],

-									day5: options.locale.daysMin[(cnt++)%7],

-									day6: options.locale.daysMin[(cnt++)%7],

-									day7: options.locale.daysMin[(cnt++)%7]

-								});

-						}

-						cal

-							.find('tr:first').append(html)

-								.find('table').addClass(views[options.view]);

-						fill(cal.get(0));

-						if (options.flat) {

-							cal.appendTo(this).show().css('position', 'relative');

-							/*layout(cal.get(0)); */

-						} else {

-							cal.appendTo(document.body);

-							$(this).bind(options.eventName, show);

-						}

-					}

-				});

-			},

-			showPicker: function() {

-				return this.each( function () {

-					if ($(this).data('datepickerId')) {

-						show.apply(this);

-					}

-				});

-			},

-			hidePicker: function() {

-				return this.each( function () {

-					if ($(this).data('datepickerId')) {

-						$('#' + $(this).data('datepickerId')).hide();

-					}

-				});

-			},

-			setDate: function(date, shiftTo){

-				return this.each(function(){

-					if ($(this).data('datepickerId')) {

-						var cal = $('#' + $(this).data('datepickerId'));

-						var options = cal.data('datepicker');

-						options.date = date;

-						if (options.date.constructor == String) {

-							options.date = parseDate(options.date, options.format);

-							options.date.setHours(0,0,0,0);

-						}

-						if (options.mode != 'single') {

-							if (options.date.constructor != Array) {

-								options.date = [options.date.valueOf()];

-								if (options.mode == 'range') {

-									options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());

-								}

-							} else {

-								for (var i = 0; i < options.date.length; i++) {

-									options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();

-								}

-								if (options.mode == 'range') {

-									options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();

-								}

-							}

-						} else {

-							options.date = options.date.valueOf();

-						}

-						if (shiftTo) {

-							options.current = new Date (options.mode != 'single' ? options.date[0] : options.date);

-						}

-						fill(cal.get(0));

-					}

-				});

-			},

-			getDate: function(formated) {

-				if (this.size() > 0) {

-					return prepareDate($('#' + $(this).data('datepickerId')).data('datepicker'))[formated ? 0 : 1];

-				}

-			},

-			clear: function(){

-				return this.each(function(){

-					if ($(this).data('datepickerId')) {

-						var cal = $('#' + $(this).data('datepickerId'));

-						var options = cal.data('datepicker');

-						if (options.mode != 'single') {

-							options.date = [];

-							fill(cal.get(0));

-						}

-					}

-				});

-			},

-			fixLayout: function(){

-				return this.each(function(){

-					if ($(this).data('datepickerId')) {

-						var cal = $('#' + $(this).data('datepickerId'));

-						var options = cal.data('datepicker');

-						if (options.flat) {

-							layout(cal.get(0));

-						}

-					}

-				});

-			}

-		};

-	}();

-	$.fn.extend({

-		DatePicker: DatePicker.init,

-		DatePickerHide: DatePicker.hidePicker,

-		DatePickerShow: DatePicker.showPicker,

-		DatePickerSetDate: DatePicker.setDate,

-		DatePickerGetDate: DatePicker.getDate,

-		DatePickerClear: DatePicker.clear,

-		DatePickerLayout: DatePicker.fixLayout

-	});

-})(jQuery);

-

-(function(){

-  var cache = {};

- 

-  this.tmpl = function tmpl(str, data){

-    // Figure out if we're getting a template, or if we need to

-    // load the template - and be sure to cache the result.

-    var fnr = !/\W/.test(str) ?

-      cache[str] = cache[str] ||

-        tmpl(document.getElementById(str).innerHTML) :

-     

-      // Generate a reusable function that will serve as a template

-      // generator (and which will be cached).

-      new Function("obj",

-        "var p=[],print=function(){p.push.apply(p,arguments);};" +

-       

-        // Introduce the data as local variables using with(){}

-        "with(obj){p.push('" +

-       

-        // Convert the template into pure JavaScript

-        str

-          .replace(/[\r\t\n]/g, "")

-          .split("<%").join("\t")

-          .replace(/((^|%>)[^\t]*)'/g, "$1\r")

-          .replace(/\t=(.*?)%>/g, "',$1,'")

-          .split("\t").join("');")

-          .split("%>").join("p.push('")

-          .split("\r").join("\\'")

-      + "');}return p.join('');");

-   

-    // Provide some basic currying to the user

-    return data ? fnr( data ) : fnr;

-  };

-})();

-

-(function($){

-	var initLayout = function() {

-		var hash = window.location.hash.replace('#', '');

-		var currentTab = $('ul.navigationTabs a')

-							.bind('click', showTab)

-							.filter('a[rel=#]'); 

-		if (currentTab.size() == 0) {

-			currentTab = $('ul.navigationTabs a:first');

-		}

-		showTab.apply(currentTab.get(0));

-		$('#date').DatePicker({

-			flat: true,

-			date: '2008-07-31',

-			current: '2008-07-31',

-			calendars: 1,

-			starts: 1,

-			view: 'years'

-		}); 

-		var now = new Date();

-		now.addDays(-10);

-		var now2 = new Date();

-		now2.addDays(-5);

-		now2.setHours(0,0,0,0);

-		

-	

-		var now3 = new Date();

-		now3.addDays(-4);

-		var now4 = new Date()

-		$('#widgetCalendar').DatePicker({

-			flat: true,

-			format: 'd B, Y',

-			date: [new Date(now3), new Date(now4)],

-			calendars: 2,

-			mode: 'range',

-			starts: 1,

-			onChange: function(formated) {

-				$('#widgetField input').val(formated.join('-'));

-			}

-		});

-		var state = false;

-		$('#widgetField>a').bind('click', function(){

-			$('#widgetCalendar').stop().animate({height: state ? 0 : $('#widgetCalendar div.datepicker').get(0).offsetHeight}, 500).toggleClass('oveflow');

-			state = !state;

-			return false;

-		});

-		$('#widgetCalendar div.datepicker').css('position', 'absolute');

-	};

-	

-	var showTab = function(e) {

-		var tabIndex = $('ul.navigationTabs a')

-							.removeClass('active')

-							.index(this);

-		$(this)

-			.addClass('active')

-			.blur();

-		$('div.tab')

-			.hide()

-				.eq(tabIndex)

-				.show();

-	}; 

-	

-    	EYE.register(initLayout, 'init');

-})(jQuery)

Side-by-side diff View file
src/DaVinci/TaxiBundle/Resources/public/js/datarange.js

+// Datapicker

+/**

+ *

+ * Date picker

+ * Author: Stefan Petre www.eyecon.ro

+ * 

+ * Dual licensed under the MIT and GPL licenses

+ * 

+ */

+ (function($){

+	var EYE = window.EYE = function() {

+		var _registered = {

+			init: []

+		};

+		return {

+			init: function() {

+				$.each(_registered.init, function(nr, fn){

+					fn.call();

+				});

+			},

+			extend: function(prop) {

+				for (var i in prop) {

+					if (prop[i] != undefined) {

+						this[i] = prop[i];

+					}

+				}

+			},

+			register: function(fn, type) {

+				if (!_registered[type]) {

+					_registered[type] = [];

+				}

+				_registered[type].push(fn);

+			}

+		};

+	}();

+	$(EYE.init);

+})(jQuery);

+

+

+//The main Datapicker  

+(function ($) {

+	var DatePicker = function () {

+		var	ids = {},

+			views = {

+				years: 'datepickerViewYears',

+				moths: 'datepickerViewMonths',

+				days: 'datepickerViewDays'

+			},

+			tpl = {

+				wrapper: '<div class="datepicker"><div class="datepickerContainer"><table cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></div></div>',

+				head: [

+					'<td>',

+					'<table cellspacing="0" cellpadding="0">',

+						'<thead>',

+							'<tr>',

+								'<th class="datepickerGoPrev"><a href="#"><span><%=prev%></span></a></th>',

+								'<th colspan="5" class="datepickerMonth"><a href="#"><span></span></a></th>',

+								'<th class="datepickerGoNext"><a href="#"><span><%=next%></span></a></th>',

+							'</tr>',

+							'<tr class="datepickerDoW">',

+								'<th><span><%=day1%></span></th>',

+								'<th><span><%=day2%></span></th>',

+								'<th><span><%=day3%></span></th>',

+								'<th><span><%=day4%></span></th>',

+								'<th><span><%=day5%></span></th>',

+								'<th><span><%=day6%></span></th>',

+								'<th><span><%=day7%></span></th>',

+							'</tr>',

+						'</thead>',

+					'</table></td>'

+				],

+				space : '<td class="datepickerSpace"><div></div></td>',

+				days: [

+					'<tbody class="datepickerDays">',

+						'<tr>',

+							'<td class="<%=weeks[0].days[0].classname%>"><a href="#"><span><%=weeks[0].days[0].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[1].classname%>"><a href="#"><span><%=weeks[0].days[1].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[2].classname%>"><a href="#"><span><%=weeks[0].days[2].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[3].classname%>"><a href="#"><span><%=weeks[0].days[3].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[4].classname%>"><a href="#"><span><%=weeks[0].days[4].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[5].classname%>"><a href="#"><span><%=weeks[0].days[5].text%></span></a></td>',

+							'<td class="<%=weeks[0].days[6].classname%>"><a href="#"><span><%=weeks[0].days[6].text%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td class="<%=weeks[1].days[0].classname%>"><a href="#"><span><%=weeks[1].days[0].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[1].classname%>"><a href="#"><span><%=weeks[1].days[1].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[2].classname%>"><a href="#"><span><%=weeks[1].days[2].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[3].classname%>"><a href="#"><span><%=weeks[1].days[3].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[4].classname%>"><a href="#"><span><%=weeks[1].days[4].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[5].classname%>"><a href="#"><span><%=weeks[1].days[5].text%></span></a></td>',

+							'<td class="<%=weeks[1].days[6].classname%>"><a href="#"><span><%=weeks[1].days[6].text%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td class="<%=weeks[2].days[0].classname%>"><a href="#"><span><%=weeks[2].days[0].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[1].classname%>"><a href="#"><span><%=weeks[2].days[1].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[2].classname%>"><a href="#"><span><%=weeks[2].days[2].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[3].classname%>"><a href="#"><span><%=weeks[2].days[3].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[4].classname%>"><a href="#"><span><%=weeks[2].days[4].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[5].classname%>"><a href="#"><span><%=weeks[2].days[5].text%></span></a></td>',

+							'<td class="<%=weeks[2].days[6].classname%>"><a href="#"><span><%=weeks[2].days[6].text%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td class="<%=weeks[3].days[0].classname%>"><a href="#"><span><%=weeks[3].days[0].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[1].classname%>"><a href="#"><span><%=weeks[3].days[1].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[2].classname%>"><a href="#"><span><%=weeks[3].days[2].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[3].classname%>"><a href="#"><span><%=weeks[3].days[3].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[4].classname%>"><a href="#"><span><%=weeks[3].days[4].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[5].classname%>"><a href="#"><span><%=weeks[3].days[5].text%></span></a></td>',

+							'<td class="<%=weeks[3].days[6].classname%>"><a href="#"><span><%=weeks[3].days[6].text%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td class="<%=weeks[4].days[0].classname%>"><a href="#"><span><%=weeks[4].days[0].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[1].classname%>"><a href="#"><span><%=weeks[4].days[1].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[2].classname%>"><a href="#"><span><%=weeks[4].days[2].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[3].classname%>"><a href="#"><span><%=weeks[4].days[3].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[4].classname%>"><a href="#"><span><%=weeks[4].days[4].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[5].classname%>"><a href="#"><span><%=weeks[4].days[5].text%></span></a></td>',

+							'<td class="<%=weeks[4].days[6].classname%>"><a href="#"><span><%=weeks[4].days[6].text%></span></a></td>',

+						'</tr>',

+					'</tbody>'

+				],

+				months: [

+					'<tbody class="<%=className%>">',

+						'<tr>',

+							'<td colspan="2"><a href="#"><span><%=data[0]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[1]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[2]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[3]%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td colspan="2"><a href="#"><span><%=data[4]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[5]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[6]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[7]%></span></a></td>',

+						'</tr>',

+						'<tr>',

+							'<td colspan="2"><a href="#"><span><%=data[8]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[9]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[10]%></span></a></td>',

+							'<td colspan="2"><a href="#"><span><%=data[11]%></span></a></td>',

+						'</tr>',

+					'</tbody>'

+				]

+			},

+			defaults = {

+				flat: false,

+				starts: 1,

+				prev: '&#9664;',

+				next: '&#9654;',

+				lastSel: false,

+				mode: 'single',

+				view: 'days',

+				calendars: 1,

+				format: 'Y-m-d',

+				position: 'bottom',

+				eventName: 'click',

+				onRender: function(){return {};},

+				onChange: function(){return true;},

+				onShow: function(){return true;},

+				onBeforeShow: function(){return true;},

+				onHide: function(){return true;},

+				locale: {

+					days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],

+					daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],

+					daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],

+					months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],

+					/*months: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"], */

+					monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

+					weekMin: 'wk'

+				}

+			},

+			fill = function(el) {

+				var options = $(el).data('datepicker');

+				var cal = $(el);

+				var currentCal = Math.floor(options.calendars/2), date, data, dow, month, cnt = 0, week, days, indic, indic2, html, tblCal;

+				cal.find('td>table tbody').remove();

+				for (var i = 0; i < options.calendars; i++) {

+					date = new Date(options.current);

+					date.addMonths(-currentCal + i);

+					tblCal = cal.find('table').eq(i+1);

+					switch (tblCal[0].className) {

+						case 'datepickerViewDays':

+							dow = formatDate(date, 'B, Y');

+							break;

+						case 'datepickerViewMonths':

+							dow = date.getFullYear();

+							break;

+						case 'datepickerViewYears':

+							dow = (date.getFullYear()-6) + ' - ' + (date.getFullYear()+5);

+							break;

+					} 

+					tblCal.find('thead tr:first th:eq(1) span').text(dow);

+					dow = date.getFullYear()-6;

+					data = {

+						data: [],

+						className: 'datepickerYears'

+					}

+					for ( var j = 0; j < 12; j++) {

+						data.data.push(dow + j);

+					}

+					html = tmpl(tpl.months.join(''), data);

+					date.setDate(1);

+					data = {weeks:[], test: 10};

+					month = date.getMonth();

+					var dow = (date.getDay() - options.starts) % 7;

+					date.addDays(-(dow + (dow < 0 ? 7 : 0)));

+					week = -1;

+					cnt = 0;

+					while (cnt < 42) {

+						indic = parseInt(cnt/7,10);

+						indic2 = cnt%7;

+						if (!data.weeks[indic]) {

+							week = date.getWeekNumber();

+							data.weeks[indic] = {

+								week: week,

+								days: []

+							};

+						}

+						data.weeks[indic].days[indic2] = {

+							text: date.getDate(),

+							classname: []

+						};

+						if (month != date.getMonth()) {

+							data.weeks[indic].days[indic2].classname.push('datepickerNotInMonth');

+						}

+						if (date.getDay() == 0) {

+							data.weeks[indic].days[indic2].classname.push('datepickerSunday');

+						}

+						if (date.getDay() == 6) {

+							data.weeks[indic].days[indic2].classname.push('datepickerSaturday');

+						}

+						var fromUser = options.onRender(date);

+						var val = date.valueOf();

+						if (fromUser.selected || options.date == val || $.inArray(val, options.date) > -1 || (options.mode == 'range' && val >= options.date[0] && val <= options.date[1])) {

+							data.weeks[indic].days[indic2].classname.push('datepickerSelected');

+						}

+						if (fromUser.disabled) {

+							data.weeks[indic].days[indic2].classname.push('datepickerDisabled');

+						}

+						if (fromUser.className) {

+							data.weeks[indic].days[indic2].classname.push(fromUser.className);

+						}

+						data.weeks[indic].days[indic2].classname = data.weeks[indic].days[indic2].classname.join(' ');

+						cnt++;

+						date.addDays(1);

+					}

+					html = tmpl(tpl.days.join(''), data) + html;

+					data = {

+						data: options.locale.monthsShort,

+						className: 'datepickerMonths'

+					};

+					html = tmpl(tpl.months.join(''), data) + html;

+					tblCal.append(html);

+				}

+			},

+			parseDate = function (date, format) {

+				if (date.constructor == Date) {

+					return new Date(date);

+				}

+				var parts = date.split(/\W+/);

+				var against = format.split(/\W+/), d, m, y, h, min, now = new Date();

+				for (var i = 0; i < parts.length; i++) {

+					switch (against[i]) {

+						case 'd':

+						case 'e':

+							d = parseInt(parts[i],10);

+							break;

+						case 'm':

+							m = parseInt(parts[i], 10)-1;

+							break;

+						case 'Y':

+						case 'y':

+							y = parseInt(parts[i], 10);

+							y += y > 100 ? 0 : (y < 29 ? 2000 : 1900);

+							break;

+						case 'H':

+						case 'I':

+						case 'k':

+						case 'l':

+							h = parseInt(parts[i], 10);

+							break;

+						case 'P':

+						case 'p':

+							if (/pm/i.test(parts[i]) && h < 12) {

+								h += 12;

+							} else if (/am/i.test(parts[i]) && h >= 12) {

+								h -= 12;

+							}

+							break;

+						case 'M':

+							min = parseInt(parts[i], 10);

+							break;

+					}

+				}

+				return new Date(

+					y === undefined ? now.getFullYear() : y,

+					m === undefined ? now.getMonth() : m,

+					d === undefined ? now.getDate() : d,

+					h === undefined ? now.getHours() : h,

+					min === undefined ? now.getMinutes() : min,

+					0

+				);

+			},

+			formatDate = function(date, format) {

+				var m = date.getMonth();

+				var d = date.getDate();

+				var y = date.getFullYear();

+				var wn = date.getWeekNumber();

+				var w = date.getDay();

+				var s = {};

+				var hr = date.getHours();

+				var pm = (hr >= 12);

+				var ir = (pm) ? (hr - 12) : hr;

+				var dy = date.getDayOfYear();

+				if (ir == 0) {

+					ir = 12;

+				}

+				var min = date.getMinutes();

+				var sec = date.getSeconds();

+				var parts = format.split(''), part;

+				for ( var i = 0; i < parts.length; i++ ) {

+					part = parts[i];

+					switch (parts[i]) {

+						case 'a':

+							part = date.getDayName();

+							break;

+						case 'A':

+							part = date.getDayName(true);

+							break;

+						case 'b':

+							part = date.getMonthName();

+							break;

+						case 'B':

+							part = date.getMonthName(true);

+							break;

+						case 'C':

+							part = 1 + Math.floor(y / 100);

+							break;

+						case 'd':

+							part = (d < 10) ? ("0" + d) : d;

+							break;

+						case 'e':

+							part = d;

+							break;

+						case 'H':

+							part = (hr < 10) ? ("0" + hr) : hr;

+							break;

+						case 'I':

+							part = (ir < 10) ? ("0" + ir) : ir;

+							break;

+						case 'j':

+							part = (dy < 100) ? ((dy < 10) ? ("00" + dy) : ("0" + dy)) : dy;

+							break;

+						case 'k':

+							part = hr;

+							break;

+						case 'l':

+							part = ir;

+							break;

+						case 'm':

+							part = (m < 9) ? ("0" + (1+m)) : (1+m);

+							break;

+						case 'M':

+							part = (min < 10) ? ("0" + min) : min;

+							break;

+						case 'p':

+						case 'P':

+							part = pm ? "PM" : "AM";

+							break;

+						case 's':

+							part = Math.floor(date.getTime() / 1000);

+							break;

+						case 'S':

+							part = (sec < 10) ? ("0" + sec) : sec;

+							break;

+						case 'u':

+							part = w + 1;

+							break;

+						case 'w':

+							part = w;

+							break;

+						case 'y':

+							part = ('' + y).substr(2, 2);

+							break;

+						case 'Y':

+							part = y;

+							break;

+					}

+					parts[i] = part;

+				}

+				return parts.join('');

+			},

+			extendDate = function(options) {

+				if (Date.prototype.tempDate) {

+					return;

+				}

+				Date.prototype.tempDate = null;

+				Date.prototype.months = options.months;

+				Date.prototype.monthsShort = options.monthsShort;

+				Date.prototype.days = options.days;

+				Date.prototype.daysShort = options.daysShort;

+				Date.prototype.getMonthName = function(fullName) {

+					return this[fullName ? 'months' : 'monthsShort'][this.getMonth()];

+				};

+				Date.prototype.getDayName = function(fullName) {

+					return this[fullName ? 'days' : 'daysShort'][this.getDay()];

+				};

+				Date.prototype.addDays = function (n) {

+					this.setDate(this.getDate() + n);

+					this.tempDate = this.getDate();

+				};

+				Date.prototype.addMonths = function (n) {

+					if (this.tempDate == null) {

+						this.tempDate = this.getDate();

+					}

+					this.setDate(1);

+					this.setMonth(this.getMonth() + n);

+					this.setDate(Math.min(this.tempDate, this.getMaxDays()));

+				};

+				Date.prototype.addYears = function (n) {

+					if (this.tempDate == null) {

+						this.tempDate = this.getDate();

+					}

+					this.setDate(1);

+					this.setFullYear(this.getFullYear() + n);

+					this.setDate(Math.min(this.tempDate, this.getMaxDays()));

+				};

+				Date.prototype.getMaxDays = function() {

+					var tmpDate = new Date(Date.parse(this)),

+						d = 28, m;

+					m = tmpDate.getMonth();

+					d = 28;

+					while (tmpDate.getMonth() == m) {

+						d ++;

+						tmpDate.setDate(d);

+					}

+					return d - 1;

+				};

+				Date.prototype.getFirstDay = function() {

+					var tmpDate = new Date(Date.parse(this));

+					tmpDate.setDate(1);

+					return tmpDate.getDay();

+				};

+				Date.prototype.getWeekNumber = function() {

+					var tempDate = new Date(this);

+					tempDate.setDate(tempDate.getDate() - (tempDate.getDay() + 6) % 7 + 3);

+					var dms = tempDate.valueOf();

+					tempDate.setMonth(0);

+					tempDate.setDate(4);

+					return Math.round((dms - tempDate.valueOf()) / (604800000)) + 1;

+				};

+				Date.prototype.getDayOfYear = function() {

+					var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);

+					var then = new Date(this.getFullYear(), 0, 0, 0, 0, 0);

+					var time = now - then;

+					return Math.floor(time / 24*60*60*1000);

+				};

+			},

+			

+			click = function(ev) {

+				if ($(ev.target).is('span')) {

+					ev.target = ev.target.parentNode;

+				}

+				var el = $(ev.target);

+				if (el.is('a')) {

+					ev.target.blur();

+					if (el.hasClass('datepickerDisabled')) {

+						return false;

+					}

+					var options = $(this).data('datepicker');

+					var parentEl = el.parent();

+					var tblEl = parentEl.parent().parent().parent();

+					var tblIndex = $('table', this).index(tblEl.get(0)) - 1;

+					var tmp = new Date(options.current);

+					var changed = false;

+					var fillIt = false;

+					if (parentEl.is('th')) { 

+						if (parentEl.hasClass('datepickerWeek') && options.mode == 'range' && !parentEl.next().hasClass('datepickerDisabled')) {

+							var val = parseInt(parentEl.next().text(), 10);

+							tmp.addMonths(tblIndex - Math.floor(options.calendars/2));

+							if (parentEl.next().hasClass('datepickerNotInMonth')) {

+								tmp.addMonths(val > 15 ? -1 : 1);

+							}

+							tmp.setDate(val);

+							options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();

+							tmp.setHours(23,59,59,0);

+							tmp.addDays(6);

+							options.date[1] = tmp.valueOf();

+							fillIt = true;

+							changed = true;

+							options.lastSel = false;

+						} 

+						else if (parentEl.parent().parent().is('thead')) {

+							switch (tblEl.get(0).className) {

+								case 'datepickerViewDays':

+									options.current.addMonths(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);

+									break;

+								case 'datepickerViewMonths':

+									options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);

+									break;

+								case 'datepickerViewYears':

+									options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -12 : 12);

+									break;

+							}

+							fillIt = true;

+						}

+					} else if (parentEl.is('td') && !parentEl.hasClass('datepickerDisabled')) {

+						switch (tblEl.get(0).className) {

+							case 'datepickerViewMonths':

+								options.current.setMonth(tblEl.find('tbody.datepickerMonths td').index(parentEl));

+								options.current.setFullYear(parseInt(tblEl.find('thead th.datepickerMonth span').text(), 10));

+								options.current.addMonths(Math.floor(options.calendars/2) - tblIndex);

+								tblEl.get(0).className = 'datepickerViewDays';

+								break;

+							case 'datepickerViewYears':

+								options.current.setFullYear(parseInt(el.text(), 10));

+								tblEl.get(0).className = 'datepickerViewMonths';

+								break;

+							default:

+								var val = parseInt(el.text(), 10);

+								tmp.addMonths(tblIndex - Math.floor(options.calendars/2));

+								if (parentEl.hasClass('datepickerNotInMonth')) {

+									tmp.addMonths(val > 15 ? -1 : 1);

+								}

+								tmp.setDate(val);

+								switch (options.mode) {

+									case 'multiple':

+										val = (tmp.setHours(0,0,0,0)).valueOf();

+										if ($.inArray(val, options.date) > -1) {

+											$.each(options.date, function(nr, dat){

+												if (dat == val) {

+													options.date.splice(nr,1);

+													return false;

+												}

+											});

+										} else {

+											options.date.push(val);

+										}

+										break;

+									case 'range':

+										if (!options.lastSel) {

+											options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();

+										}

+										val = (tmp.setHours(23,59,59,0)).valueOf();

+										if (val < options.date[0]) {

+											options.date[1] = options.date[0] + 86399000;

+											options.date[0] = val - 86399000;

+										} else {

+											options.date[1] = val;

+										}

+										options.lastSel = !options.lastSel;

+										break;

+									default:

+										options.date = tmp.valueOf();

+										break;

+								}

+								break;

+						}

+						fillIt = true;

+						changed = true;

+					}

+					if (fillIt) {

+						fill(this);

+					}

+					if (changed) {

+						options.onChange.apply(this, prepareDate(options));

+					}

+				}

+				return false;

+			},

+			prepareDate = function (options) {

+				var tmp;

+				if (options.mode == 'single') {

+					tmp = new Date(options.date);

+					return [formatDate(tmp, options.format), tmp, options.el];

+				} else {

+					tmp = [[],[], options.el];

+					$.each(options.date, function(nr, val){

+						var date = new Date(val);

+						options.format = 'd/m/Y'

+						tmp[0].push(formatDate(date, options.format));

+						tmp[1].push(date);

+					});

+					return tmp;

+				}

+			},

+			getViewport = function () {

+				var m = document.compatMode == 'CSS1Compat';

+				return {

+					l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),

+					t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),

+					w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),

+					h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)

+				};

+			},

+			isChildOf = function(parentEl, el, container) {

+				if (parentEl == el) {

+					return true;

+				}

+				if (parentEl.contains) {

+					return parentEl.contains(el);

+				}

+				if ( parentEl.compareDocumentPosition ) {

+					return !!(parentEl.compareDocumentPosition(el) & 16);

+				}

+				var prEl = el.parentNode;

+				while(prEl && prEl != container) {

+					if (prEl == parentEl)

+						return true;

+					prEl = prEl.parentNode;

+				}

+				return false;

+			},

+			show = function (ev) {

+				var cal = $('#' + $(this).data('datepickerId'));

+				if (!cal.is(':visible')) {

+					var calEl = cal.get(0);

+					fill(calEl);

+					var options = cal.data('datepicker');

+					options.onBeforeShow.apply(this, [cal.get(0)]);

+					var pos = $(this).offset();

+					var viewPort = getViewport();

+					var top = pos.top;

+					var left = pos.left;

+					var oldDisplay = $.curCSS(calEl, 'display');

+					cal.css({

+						visibility: 'hidden',

+						display: 'block'

+					});

+					layout(calEl);

+					switch (options.position){

+						case 'top':

+							top -= calEl.offsetHeight;

+							break;

+						case 'left':

+							left -= calEl.offsetWidth;

+							break;

+						case 'right':

+							left += this.offsetWidth;

+							break;

+						case 'bottom':

+							top += this.offsetHeight;

+							break;

+					}

+					if (top + calEl.offsetHeight > viewPort.t + viewPort.h) {

+						top = pos.top  - calEl.offsetHeight;

+					}

+					if (top < viewPort.t) {

+						top = pos.top + this.offsetHeight + calEl.offsetHeight;

+					}

+					if (left + calEl.offsetWidth > viewPort.l + viewPort.w) {

+						left = pos.left - calEl.offsetWidth;

+					}

+					if (left < viewPort.l) {

+						left = pos.left + this.offsetWidth

+					}

+					cal.css({

+						visibility: 'visible',

+						display: 'block',

+						top: top + 'px',

+						left: left + 'px'

+					});

+					if (options.onShow.apply(this, [cal.get(0)]) != false) {

+						cal.show();

+					}

+					$(document).bind('mousedown', {cal: cal, trigger: this}, hide);

+				}

+				return false;

+			},

+			hide = function (ev) {

+				if (ev.target != ev.data.trigger && !isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {

+					if (ev.data.cal.data('datepicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {

+						ev.data.cal.hide();

+					}

+					$(document).unbind('mousedown', hide);

+				}

+			};

+		return {

+			init: function(options){

+				options = $.extend({}, defaults, options||{});

+				extendDate(options.locale);

+				options.calendars = Math.max(1, parseInt(options.calendars,10)||1);

+				options.mode = /single|multiple|range/.test(options.mode) ? options.mode : 'single';

+				return this.each(function(){

+					if (!$(this).data('datepicker')) {

+						options.el = this;

+						if (options.date.constructor == String) {

+							options.date = parseDate(options.date, options.format);

+							options.date.setHours(0,0,0,0);

+						}

+						if (options.mode != 'single') {

+							if (options.date.constructor != Array) {

+								options.date = [options.date.valueOf()];

+								if (options.mode == 'range') {

+									options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());

+								}

+							} else {

+								for (var i = 0; i < options.date.length; i++) {

+									options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();

+								}

+								if (options.mode == 'range') {

+									options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();

+								}

+							}

+						} else {

+							options.date = options.date.valueOf();

+						}

+						if (!options.current) {

+							options.current = new Date();

+						} else {

+							options.current = parseDate(options.current, options.format);

+						} 

+						options.current.setDate(1);

+						options.current.setHours(0,0,0,0);

+						var id = 'datepicker_' + parseInt(Math.random() * 1000), cnt;

+						options.id = id;

+						$(this).data('datepickerId', options.id);

+						var cal = $(tpl.wrapper).attr('id', id).bind('click', click).data('datepicker', options);

+						if (options.className) {

+							cal.addClass(options.className);

+						}

+						var html = '';

+						for (var i = 0; i < options.calendars; i++) {

+							cnt = options.starts;

+							if (i > 0) {

+								html += tpl.space;

+							}

+							html += tmpl(tpl.head.join(''), {

+									week: options.locale.weekMin,

+									prev: options.prev,

+									next: options.next,

+									day1: options.locale.daysMin[(cnt++)%7],

+									day2: options.locale.daysMin[(cnt++)%7],

+									day3: options.locale.daysMin[(cnt++)%7],

+									day4: options.locale.daysMin[(cnt++)%7],

+									day5: options.locale.daysMin[(cnt++)%7],

+									day6: options.locale.daysMin[(cnt++)%7],

+									day7: options.locale.daysMin[(cnt++)%7]

+								});

+						}

+						cal

+							.find('tr:first').append(html)

+								.find('table').addClass(views[options.view]);

+						fill(cal.get(0));

+						if (options.flat) {

+							cal.appendTo(this).show().css('position', 'relative');

+							/*layout(cal.get(0)); */

+						} else {

+							cal.appendTo(document.body);

+							$(this).bind(options.eventName, show);

+						}

+					}

+				});

+			},

+			showPicker: function() {

+				return this.each( function () {

+					if ($(this).data('datepickerId')) {

+						show.apply(this);

+					}

+				});

+			},

+			hidePicker: function() {

+				return this.each( function () {

+					if ($(this).data('datepickerId')) {

+						$('#' + $(this).data('datepickerId')).hide();

+					}

+				});

+			},

+			setDate: function(date, shiftTo){

+				return this.each(function(){

+					if ($(this).data('datepickerId')) {

+						var cal = $('#' + $(this).data('datepickerId'));

+						var options = cal.data('datepicker');

+						options.date = date;

+						if (options.date.constructor == String) {

+							options.date = parseDate(options.date, options.format);

+							options.date.setHours(0,0,0,0);

+						}

+						if (options.mode != 'single') {

+							if (options.date.constructor != Array) {

+								options.date = [options.date.valueOf()];

+								if (options.mode == 'range') {

+									options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());

+								}

+							} else {

+								for (var i = 0; i < options.date.length; i++) {

+									options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();

+								}

+								if (options.mode == 'range') {

+									options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();

+								}

+							}

+						} else {

+							options.date = options.date.valueOf();

+						}

+						if (shiftTo) {

+							options.current = new Date (options.mode != 'single' ? options.date[0] : options.date);

+						}

+						fill(cal.get(0));

+					}

+				});

+			},

+			getDate: function(formated) {

+				if (this.size() > 0) {

+					return prepareDate($('#' + $(this).data('datepickerId')).data('datepicker'))[formated ? 0 : 1];

+				}

+			},

+			clear: function(){

+				return this.each(function(){

+					if ($(this).data('datepickerId')) {

+						var cal = $('#' + $(this).data('datepickerId'));

+						var options = cal.data('datepicker');

+						if (options.mode != 'single') {

+							options.date = [];

+							fill(cal.get(0));

+						}

+					}

+				});

+			},

+			fixLayout: function(){

+				return this.each(function(){

+					if ($(this).data('datepickerId')) {

+						var cal = $('#' + $(this).data('datepickerId'));

+						var options = cal.data('datepicker');

+						if (options.flat) {

+							layout(cal.get(0));

+						}

+					}

+				});

+			}

+		};

+	}();

+	$.fn.extend({

+		DatePicker: DatePicker.init,

+		DatePickerHide: DatePicker.hidePicker,

+		DatePickerShow: DatePicker.showPicker,

+		DatePickerSetDate: DatePicker.setDate,

+		DatePickerGetDate: DatePicker.getDate,

+		DatePickerClear: DatePicker.clear,

+		DatePickerLayout: DatePicker.fixLayout

+	});

+})(jQuery);

+

+(function(){

+  var cache = {};

+ 

+  this.tmpl = function tmpl(str, data){

+    // Figure out if we're getting a template, or if we need to

+    // load the template - and be sure to cache the result.

+    var fnr = !/\W/.test(str) ?

+      cache[str] = cache[str] ||

+        tmpl(document.getElementById(str).innerHTML) :

+     

+      // Generate a reusable function that will serve as a template

+      // generator (and which will be cached).

+      new Function("obj",

+        "var p=[],print=function(){p.push.apply(p,arguments);};" +

+       

+        // Introduce the data as local variables using with(){}

+        "with(obj){p.push('" +

+       

+        // Convert the template into pure JavaScript

+        str

+          .replace(/[\r\t\n]/g, "")

+          .split("<%").join("\t")

+          .replace(/((^|%>)[^\t]*)'/g, "$1\r")

+          .replace(/\t=(.*?)%>/g, "',$1,'")

+          .split("\t").join("');")

+          .split("%>").join("p.push('")

+          .split("\r").join("\\'")

+      + "');}return p.join('');");

+   

+    // Provide some basic currying to the user

+    return data ? fnr( data ) : fnr;

+  };

+})();

+

+(function($){

+	var initLayout = function() {

+		var hash = window.location.hash.replace('#', '');

+		var currentTab = $('ul.navigationTabs a')

+							.bind('click', showTab)

+							.filter('a[rel=#]'); 

+		if (currentTab.size() == 0) {

+			currentTab = $('ul.navigationTabs a:first');

+		}

+		showTab.apply(currentTab.get(0));

+		$('#date').DatePicker({

+			flat: true,

+			date: '2008-07-31',

+			current: '2008-07-31',

+			calendars: 1,

+			starts: 1,

+			view: 'years'

+		}); 

+		var now = new Date();

+		now.addDays(-10);

+		var now2 = new Date();

+		now2.addDays(-5);

+		now2.setHours(0,0,0,0);

+		

+	

+		var now3 = new Date();

+		now3.addDays(-4);

+		var now4 = new Date()

+		$('#widgetCalendar').DatePicker({

+			flat: true,

+			format: 'd B, Y',

+			date: [new Date(now3), new Date(now4)],

+			calendars: 2,

+			mode: 'range',

+			starts: 1,

+			onChange: function(formated) {

+				$('#widgetField input').val(formated.join('-'));

+			}

+		});

+		var state = false;

+		$('#widgetField>a').bind('click', function(){

+			$('#widgetCalendar').stop().animate({height: state ? 0 : $('#widgetCalendar div.datepicker').get(0).offsetHeight}, 500).toggleClass('oveflow');

+			state = !state;

+			return false;

+		});

+		$('#widgetCalendar div.datepicker').css('position', 'absolute');

+	};

+	

+	var showTab = function(e) {

+		var tabIndex = $('ul.navigationTabs a')

+							.removeClass('active')

+							.index(this);

+		$(this)

+			.addClass('active')

+			.blur();

+		$('div.tab')

+			.hide()

+				.eq(tabIndex)

+				.show();

+	}; 

+	

+    	EYE.register(initLayout, 'init');

+})(jQuery)

Side-by-side diff View file
src/DaVinci/TaxiBundle/Resources/views/base.html.twig

         <header  class="header-wrapper">

             <div class="header-top">

                 <div class="header-top-in">

-                    <div class="logo">

-                        <a href="{{ url('da_vinci_taxi_homepage') }}">

-                            <img src="{{ asset('bundles/davincitaxi/images/logo.png') }}" alt="{{ 'Taxi My Price'|trans}}" />

-                        </a>

-                    </div>

-                    <nav class="topmenu-left">

-                        <ul class="uk-subnav uk-subnav-pill">

-                            <li><a href="#" class="text-item">{{ 'About'|trans }}</a></li>

-                            <li><a href="#" class="text-item">{{ 'Help'|trans }}</a></li>

+                    <nav class="topmenu">

+						<ul class="uk-subnav uk-subnav-pill">

+							<li>

+								<a href="{{ url('da_vinci_taxi_homepage') }}">

+									<img src="{{ asset('bundles/davincitaxi/images/logo.png') }}" alt="{{ 'Taxi My Price'|trans}}" />

+								</a>

+							</li>

+							<li></li>

                             <li class="nest">

-                                <a href="#" class="uk-button-danger figur-item"><i class="mp-icon-person"></i></a>

-                                <span>{{ 'Profit'|trans }}</span>

-                                <a href="#" class="uk-button-primary figur-item"><i class="mp-icon-taxi"></i></a>

+								<a href="#" class="texst-item">{{ 'About'|trans }}</a>

+								<a href="#" class="texst-item">{{ 'Help'|trans }}</a>

+								<a href="#" class="nest-item">

+									<span class="uk-button-danger figur-item"><i class="mp-icon-person"></i></span>

+									<span>{{ 'Profit'|trans }}</span>

+									<span class="uk-button-primary figur-item"><i class="mp-icon-taxi"></i></span>

+								</a>

                             </li>

-                        </ul>

-                    </nav>

-                    <div class="topmenu-right">

-                        <div class="book-store">

-                            <a class="book uk-button-danger" href="#">{{ 'Book'|trans }}</a>

-                            <a href="#" class="uk-button-primary">{{ 'Store'|trans }}</a>

-                            <div class="thumb">

-                                <i class="mp-icon-good"></i>

-                            </div>

-                        </div>

-

+							<li class="empty-middle"></li>

+                    

+						<li>

+							<div class="book-store">

+								<a class="book uk-button-danger" href="#">{{ 'Book'|trans }}</a>

+								<a href="#" class="uk-button-primary">{{ 'Store'|trans }}</a>

+								<div class="thumb">

+									<i class="mp-icon-good"></i>

+								</div>

+							</div>

+						</li>

+						<li>

 							{% if is_granted("IS_AUTHENTICATED_REMEMBERED") %}

-                                                <div data-uk-dropdown="" class="uk-button-dropdown">

+                             <div data-uk-dropdown="" class="uk-button-dropdown">

                             <button class="uk-button  uk-button-link autorized">

                                 <span class="caption">My account</span> <i class="uk-icon-caret-down uk-margin-small-left"></i><br/><span class="ownship">passenger</span>

                             </button>

 									{% endif %}

 

                         

-

-                    </div>

+						</li>

+                    </ul>

+				</nav>

 					<a href="javascript://" class="uk-navbar-toggle" data-uk-offcanvas="{target:'#offcanvas-nav'}"></a>

                 </div>

             </div>

 							'@DaVinciTaxiBundle/Resources/public/js/custom-form-elements.js'

 							'@DaVinciTaxiBundle/Resources/public/js/jquery.form.js'

 							'@DaVinciTaxiBundle/Resources/public/js/all.js'

+							'@DaVinciTaxiBundle/Resources/public/js/datarange.js'

 							'@DaVinciTaxiBundle/Resources/public/js/chosen.jquery.js'

 							'@DaVinciTaxiBundle/Resources/public/js/chosenImage.jquery.js'

 							'@DaVinciTaxiBundle/Resources/public/js/intl-tel-input-master/js/intlTelInput.js'

    Blog
    Support
    Plans & pricing
    Documentation
    API
    Server status
    Version info
    Terms of service
    Privacy policy

    JIRA
    Confluence
    Bamboo
    Stash
    SourceTree
    HipChat

Atlassian
