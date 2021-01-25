<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css'];
require_once VIEWS.'templates/head.php';
?>
<!-- Icon filled ellipsis -->
<svg viewBox="0 0 512.000000 128.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)">
<path d="M485 1266 c-185 -45 -348 -181 -430 -359 -42 -92 -55 -156 -55 -267
0 -111 13 -175 55 -267 66 -144 174 -252 318 -318 92 -42 156 -55 267 -55 111
0 175 13 267 55 181 83 323 256 362 443 14 68 14 216 0 284 -27 130 -123 281
-230 363 -69 54 -182 108 -257 124 -69 14 -233 13 -297 -3z"/>
<path d="M2405 1266 c-185 -45 -348 -181 -430 -359 -42 -92 -55 -156 -55 -267
0 -111 13 -175 55 -267 83 -181 256 -323 443 -362 68 -14 216 -14 284 0 187
39 360 181 443 362 42 92 55 156 55 267 0 111 -13 175 -55 267 -83 181 -256
323 -443 362 -69 14 -233 13 -297 -3z"/>
<path d="M4325 1266 c-185 -45 -348 -181 -430 -359 -42 -92 -55 -156 -55 -267
0 -111 13 -175 55 -267 83 -181 256 -323 443 -362 68 -14 216 -14 284 0 187
39 360 181 443 362 42 92 55 156 55 267 0 111 -13 175 -55 267 -83 181 -256
323 -443 362 -69 14 -233 13 -297 -3z"/>
</g>
</svg>

<!-- Icon filled editar -->
<svg viewBox="0 0 299.000000 299.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,299.000000) scale(0.100000,-0.100000)">
<path d="M2365 2970 c-22 -11 -110 -90 -195 -175 l-155 -155 313 -312 312
-313 156 155 c196 195 220 240 175 335 -26 54 -423 449 -473 470 -50 20 -85
19 -133 -5z"/>
<path d="M917 1542 l-917 -917 0 -313 0 -312 313 0 312 0 920 920 920 920
-300 301 c-165 165 -307 304 -316 309 -12 7 -213 -189 -932 -908z"/>
</g>
</svg>

<!-- Icon filled eliminar b -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M1634 5086 l-34 -34 0 -296 0 -296 -405 0 c-448 0 -460 -1 -490 -60
-14 -26 -16 -61 -13 -217 l3 -185 33 -29 32 -29 1800 0 1800 0 32 29 33 29 3
185 c3 156 1 191 -13 217 -30 59 -42 60 -490 60 l-405 0 0 296 0 296 -34 34
-34 34 -892 0 -892 0 -34 -34z m1456 -501 l0 -105 -530 0 -530 0 0 105 0 105
530 0 530 0 0 -105z"/>
<path d="M1002 1929 l3 -1871 33 -29 32 -29 1490 0 1490 0 32 29 33 29 3 1871
2 1871 -1560 0 -1560 0 2 -1871z m918 6 l0 -1235 -210 0 -210 0 0 1235 0 1235
210 0 210 0 0 -1235z m850 0 l0 -1235 -210 0 -210 0 0 1235 0 1235 210 0 210
0 0 -1235z m850 0 l0 -1235 -210 0 -210 0 0 1235 0 1235 210 0 210 0 0 -1235z"/>
</g>
</svg>
<!-- Icon arrow b -->
<svg  viewBox="0 0 316.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M292 4827 c-160 -160 -292 -297 -292 -302 0 -5 440 -450 977 -987
l978 -978 -978 -978 c-537 -537 -977 -982 -977 -987 0 -13 582 -595 595 -595
6 0 586 576 1290 1280 l1280 1280 -1280 1280 c-704 704 -1285 1280 -1290 1280
-6 0 -142 -132 -303 -293z"/>
</g>
</svg>
<!-- Icon arrow c -->
<svg viewBox="0 0 233.000000 414.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,414.000000) scale(0.100000,-0.100000)">
<path d="M145 4116 c-60 -28 -97 -66 -124 -126 -27 -59 -28 -160 -2 -215 13
-27 280 -301 845 -865 454 -454 826 -829 826 -835 0 -5 -371 -381 -825 -835
-637 -638 -829 -835 -844 -870 -43 -95 -18 -234 55 -302 68 -64 197 -88 282
-53 26 11 316 294 981 958 758 757 948 952 967 992 30 64 33 161 5 220 -13 28
-312 333 -957 977 -728 727 -949 942 -984 957 -65 29 -160 28 -225 -3z"/>
</g>
</svg>

<!-- Icon registrar -->
<svg viewBox="0 0 384.000000 384.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,384.000000) scale(0.100000,-0.100000)">
<path d="M1255 3826 c-120 -29 -234 -123 -288 -236 l-32 -68 -112 -4 c-112 -3
-113 -3 -145 -36 l-33 -32 0 -183 c0 -168 2 -185 22 -223 34 -63 66 -97 125
-129 l53 -30 515 0 515 0 50 27 c65 34 98 70 130 140 26 56 26 62 23 228 l-3
170 -33 32 c-32 33 -33 33 -145 36 l-112 4 -29 65 c-83 184 -301 288 -501 239z"/>
<path d="M335 3346 c-160 -40 -290 -174 -324 -334 -16 -75 -16 -2110 0 -2184
36 -167 171 -301 337 -337 52 -11 1142 -17 1142 -6 0 2 -14 39 -30 81 -42 106
-77 243 -89 357 -6 53 -11 101 -11 106 0 7 -142 11 -405 13 l-405 3 -32 33
c-28 28 -33 39 -33 82 0 43 5 54 33 82 l32 33 415 3 415 3 0 23 c0 20 25 126
56 233 l6 22 -446 3 -446 3 -32 33 c-28 28 -33 39 -33 82 0 43 5 54 33 82 l32
33 505 3 504 3 55 78 c30 43 80 106 111 139 l57 62 -616 2 -616 3 -32 33 c-28
28 -33 39 -33 82 0 43 5 54 33 82 l32 33 788 5 787 5 70 33 c123 59 283 99
463 118 l62 6 0 247 c0 266 -5 303 -57 405 -65 128 -231 226 -383 226 l-40 0
0 -123 c0 -190 -33 -289 -128 -384 -57 -57 -116 -92 -201 -117 -82 -24 -1020
-24 -1102 0 -127 38 -224 115 -277 220 -40 81 -52 144 -52 284 l0 120 -47 -1
c-27 0 -70 -6 -98 -13z"/>
<path d="M2589 2145 c-156 -26 -297 -82 -431 -171 -243 -162 -415 -431 -463
-725 -74 -457 156 -910 571 -1126 649 -338 1441 62 1559 788 94 584 -308 1138
-896 1234 -111 18 -235 18 -340 0z m637 -604 c75 -34 113 -126 83 -198 -23
-53 -606 -713 -645 -729 -92 -39 -127 -18 -346 203 -199 202 -209 216 -194
298 10 49 71 111 119 120 78 15 103 2 228 -121 63 -63 118 -114 121 -114 3 0
109 118 235 263 127 144 241 267 254 274 58 28 90 29 145 4z"/>
</g>
</svg>

<!-- Icon filled modulo add -->
<svg viewBox="0 0 224.000000 224.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,224.000000) scale(0.100000,-0.100000)">
<path d="M190 2231 c-69 -21 -130 -73 -166 -141 -18 -33 -19 -74 -19 -830 0
-756 1 -797 19 -830 26 -49 74 -98 121 -123 38 -21 53 -22 384 -25 327 -3 343
-2 336 15 -82 197 -89 433 -19 618 5 13 -22 15 -236 15 -264 0 -296 6 -319 56
-14 32 -14 47 1 79 23 51 45 55 322 55 253 0 255 0 282 -23 l27 -24 58 73 c32
40 84 92 115 116 l57 43 -412 5 -413 5 -24 28 c-33 39 -31 81 5 118 l29 29
457 0 456 0 24 -24 c13 -13 27 -36 31 -51 4 -17 11 -24 21 -21 49 19 134 39
191 44 l67 7 0 300 c0 334 -1 337 -70 413 -23 27 -56 48 -91 62 -53 19 -74 20
-632 19 -317 0 -588 -4 -602 -8z m621 -399 c31 -35 36 -60 18 -95 -28 -54 -38
-57 -261 -57 -140 0 -216 4 -233 12 -28 13 -55 55 -55 86 0 24 36 71 64 82 11
5 115 8 229 7 l209 -2 29 -33z"/>
<path d="M1472 1245 c-112 -25 -207 -79 -302 -175 -66 -65 -94 -103 -122 -160
-66 -136 -83 -274 -52 -413 38 -171 142 -315 294 -407 314 -188 723 -66 884
265 229 471 -189 1001 -702 890z m195 -289 c27 -23 28 -30 33 -128 l5 -103
103 -5 c98 -5 105 -6 128 -33 31 -36 31 -78 0 -114 -23 -27 -30 -28 -128 -33
l-103 -5 -5 -103 c-5 -98 -6 -105 -33 -128 -36 -31 -78 -31 -114 0 -27 23 -28
30 -33 128 l-5 103 -103 5 c-98 5 -105 6 -128 33 -31 36 -31 78 0 114 23 27
30 28 128 33 l103 5 5 103 c5 98 6 105 33 128 16 13 41 24 57 24 16 0 41 -11
57 -24z"/>
</g>
</svg>

<!-- Icon admin c -->
<svg viewBox="0 0 448 448.09934">
<path d="m441.289062 347.539062 6.761719 10.136719v-213.578125h-16v212.691406zm0 0"/>
<path d="m400.050781 112.097656h48v16h-48zm0 0"/>
<path d="m400.050781 96.097656h48v-24c0-13.253906-10.746093-24-24-24-13.253906 0-24 10.746094-24 24zm0 0"/>
<path d="m446.816406 384.675781-8.007812-12.015625-14.757813 14.75-14.761719-14.75-8.007812 12.015625 22.769531 45.535157zm0 0"/>
<path d="m400.050781 357.675781 6.757813-10.136719 9.242187 9.25v-212.691406h-16zm0 0"/>
<path d="m32.050781 448.097656h304v-384h-304zm208-64h-16v-16h16zm32 0h-16v-16h16zm32 0h-16v-16h16zm-240-256h240v16h-240zm0 64h240v16h-240zm0 56h240v16h-240zm0 64h240v16h-240zm0 56h144v16h-144zm0 0"/><path d="m24.050781 24.097656c4.417969 0 8 3.582032 8 8v14.53125c11.519531-4.074218 18.140625-16.152344 15.378907-28.050781-2.761719-11.902344-14.023438-19.832031-26.160157-18.417969-12.132812 1.414063-21.269531 11.722656-21.2187498 23.9375v392h15.9999998v-384c0-4.417968 3.582031-8 8-8zm0 0"/>
<path d="m344.050781 48.097656c13.253907 0 24-10.742187 24-24 0-13.253906-10.746093-23.9999998-24-23.9999998h-288.207031c10.9375 14.1328128 10.9375 33.8710938 0 47.9999998zm0 0"/>
</svg>

<!-- Icon fecha -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M991 4940 c-96 -20 -198 -96 -240 -179 -39 -76 -43 -129 -39 -581 l3
-435 26 -55 c39 -82 90 -135 167 -172 60 -30 75 -33 157 -33 77 0 98 4 147 27
65 30 137 98 166 155 38 74 42 131 42 551 0 457 -3 487 -66 579 -37 53 -112
111 -172 131 -48 16 -141 22 -191 12z"/>
<path d="M3134 4940 c-109 -23 -213 -111 -256 -218 -23 -57 -23 -60 -23 -507
l0 -450 26 -62 c43 -103 116 -171 216 -204 178 -59 378 34 443 207 19 52 20
77 20 503 0 500 -1 508 -68 596 -83 109 -226 163 -358 135z"/>
<path d="M3 2673 l3 -1598 21 -75 c63 -216 144 -354 296 -508 178 -181 416
-289 687 -312 130 -11 2153 -13 2214 -2 l39 7 -59 44 c-138 104 -294 292 -375
452 l-29 58 -897 3 c-894 3 -898 4 -963 25 -164 56 -297 189 -352 352 -23 66
-23 66 -26 994 l-3 927 1576 0 1575 0 0 -230 c0 -126 3 -230 6 -230 4 0 49 7
102 16 72 13 129 15 241 10 80 -3 163 -8 184 -12 l37 -6 0 841 0 841 -260 0
-260 0 0 -258 c0 -286 -6 -329 -63 -436 -47 -91 -155 -195 -247 -239 -164 -77
-316 -77 -480 0 -95 46 -211 158 -254 248 -53 110 -58 141 -63 423 l-5 262
-514 0 -514 0 0 -242 c0 -280 -9 -341 -67 -451 -93 -177 -290 -297 -488 -297
-200 0 -394 118 -487 296 -60 114 -68 165 -68 447 l0 247 -255 0 -255 0 3
-1597z"/>
<path d="M974 2690 c-47 -11 -92 -47 -114 -90 -18 -35 -20 -60 -20 -254 0
-222 4 -253 43 -295 49 -54 85 -61 307 -61 222 0 258 7 307 61 39 43 43 72 43
297 0 206 -1 219 -23 256 -27 48 -62 75 -113 86 -46 11 -385 11 -430 0z"/>
<path d="M1921 2690 c-73 -18 -126 -82 -136 -164 -4 -30 -5 -132 -4 -227 4
-196 10 -215 82 -273 l39 -31 232 0 232 0 43 28 c76 50 83 80 79 335 -3 214
-4 219 -28 255 -13 20 -43 46 -65 59 -38 22 -51 23 -240 25 -110 1 -215 -2
-234 -7z"/>
<path d="M2868 2690 c-45 -14 -83 -41 -108 -78 -24 -35 -25 -41 -28 -254 -4
-254 3 -281 80 -331 62 -40 78 -36 127 34 104 148 298 316 459 398 46 24 50
37 31 106 -14 51 -73 110 -124 124 -46 12 -396 14 -437 1z"/>
<path d="M3798 2371 c-115 -25 -177 -46 -268 -90 -351 -171 -581 -502 -620
-891 -11 -116 -1 -268 25 -373 98 -389 400 -700 787 -807 209 -58 461 -47 674
30 333 121 593 404 690 751 35 128 45 360 19 493 -40 218 -134 401 -285 560
-102 107 -184 168 -315 232 -162 79 -273 106 -465 110 -125 3 -172 0 -242 -15z
m142 -338 c0 -69 25 -103 76 -103 48 0 74 38 74 108 l0 55 50 -6 c74 -9 210
-59 290 -106 201 -120 362 -355 386 -567 l6 -51 -62 -5 c-50 -4 -67 -9 -81
-27 -25 -30 -24 -72 1 -99 17 -18 32 -22 84 -22 l63 0 -9 -57 c-54 -345 -329
-615 -690 -677 l-38 -7 0 56 c0 31 -4 65 -10 75 -13 25 -65 41 -95 30 -33 -13
-45 -40 -45 -105 l0 -57 -42 7 c-142 24 -292 90 -396 175 -156 127 -266 323
-295 522 l-6 37 66 3 c58 3 68 6 86 30 21 28 19 58 -6 92 -11 15 -30 21 -80
24 l-66 4 5 32 c29 166 103 321 207 432 75 80 159 145 244 188 64 32 206 75
251 75 l32 1 0 -57z"/>
<path d="M3630 1828 c-38 -26 -58 -76 -47 -119 3 -13 60 -100 126 -193 117
-165 120 -171 114 -211 -10 -78 42 -172 114 -201 70 -30 168 -9 217 45 18 19
30 21 153 21 161 0 196 11 219 67 20 47 6 102 -33 132 -23 19 -40 21 -174 21
-134 0 -149 2 -158 18 -11 20 -81 58 -123 67 -21 4 -52 41 -141 167 -63 90
-124 171 -135 181 -34 31 -91 33 -132 5z"/>
<path d="M957 1776 c-48 -18 -74 -41 -99 -89 -17 -35 -19 -57 -16 -266 l3
-228 29 -37 c52 -68 83 -76 316 -76 233 0 264 8 316 76 l29 37 0 242 0 242
-28 36 c-52 68 -67 72 -302 74 -160 2 -219 0 -248 -11z"/>
<path d="M1907 1776 c-45 -17 -82 -48 -105 -91 -14 -25 -17 -64 -17 -250 0
-243 3 -256 65 -309 51 -42 89 -48 311 -44 204 3 206 3 246 30 75 49 83 82 83
323 0 240 -8 270 -82 321 l-41 29 -211 2 c-161 2 -220 0 -249 -11z"/>
</g>
</svg>

<!-- Icon label -->
<svg viewBox="0 0 512.000000 378.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,378.000000) scale(0.100000,-0.100000)">
<path d="M408 3765 c-32 -8 -85 -28 -119 -45 -80 -41 -196 -156 -233 -231 -59
-121 -56 -38 -56 -1599 0 -1561 -3 -1478 56 -1599 37 -75 153 -190 233 -230
127 -65 32 -62 1768 -59 l1578 3 59 23 c86 32 136 64 187 119 51 55 1239 1726
1239 1743 0 17 -1188 1688 -1239 1743 -51 55 -101 87 -187 119 l-59 23 -1585
2 c-1327 1 -1594 -1 -1642 -12z"/>
</g>
</svg>

<!-- Icon calendario b -->
<svg viewBox="0 0 64 64">
<g id="Calendar">
<path d="m12 47h4.001v3h-4.001z"/><path d="m49 38a11 11 0 1 0 11 11 11.013 11.013 0 0 0 -11-11zm7.192 8.222-8.485 8.485a1 1 0 0 1 -1.414 0l-4.242-4.243a1 1 0 0 1 1.414-1.414l3.535 3.536 7.778-7.778a1 1 0 0 1 1.414 1.414z"/><path d="m24 29h4.001v3h-4.001z"/><path d="m36 29h4v3h-4z"/><path d="m12 38h4.001v3h-4.001z"/><path d="m24 38h4.001v3h-4.001z"/><path d="m12 29h4.001v3h-4.001z"/><path d="m16 14a2.006 2.006 0 0 0 2-2v-6a2 2 0 0 0 -4 0v6a2.006 2.006 0 0 0 2 2z"/><path d="m32 14a2.006 2.006 0 0 0 2-2v-6a2 2 0 0 0 -4 0v6a2.006 2.006 0 0 0 2 2z"/><path d="m48 14a2.006 2.006 0 0 0 2-2v-6a2 2 0 0 0 -4 0v6a2.006 2.006 0 0 0 2 2z"/><path d="m48 29h4v3h-4z"/><path d="m57 10h-5v2a4 4 0 0 1 -8 0v-2h-8v2a4 4 0 0 1 -8 0v-2h-8v2a4 4 0 0 1 -8 0v-2h-5a3.009 3.009 0 0 0 -3 3v7h56v-7a3.009 3.009 0 0 0 -3-3z"/><path d="m24 47h4.001v3h-4.001z"/><path d="m4 22v31a3.009 3.009 0 0 0 3 3h31.063a12.984 12.984 0 1 1 21.937-13.9v-20.1zm14 28a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm0-9a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm0-9a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm12 18a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm0-9a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm0-9a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm10 6h-4v3a1 1 0 0 1 0 2 2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a1 1 0 0 1 0 2zm2-6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2zm12 0a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2-2v-3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2z"/>
</g>
</svg>

<!-- Icon filled lupa -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M1600 5100 c-415 -70 -755 -244 -1045 -535 -294 -293 -467 -634 -536
-1055 -24 -147 -26 -419 -4 -564 107 -698 560 -1262 1215 -1512 329 -126 760
-154 1095 -73 275 67 541 196 730 354 75 62 72 62 116 19 l39 -38 0 -116 0
-115 733 -733 c402 -402 737 -732 742 -732 13 0 435 422 435 435 0 6 -330 340
-733 743 l-732 732 -115 0 -116 0 -38 39 c-43 44 -43 41 19 116 193 231 339
573 386 900 19 130 16 406 -5 540 -86 539 -379 1002 -825 1299 -228 152 -503
257 -787 301 -140 21 -434 19 -574 -5z m455 -581 c563 -67 1011 -478 1132
-1039 25 -119 25 -400 0 -520 -57 -266 -170 -475 -361 -666 -191 -191 -400
-304 -666 -361 -120 -25 -401 -25 -520 0 -446 96 -808 405 -965 823 -268 711
130 1508 858 1718 180 52 344 66 522 45z"/>
</g>
</svg>

<!-- Icon filled lista -->
<svg viewBox="0 0 512.000000 422.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,422.000000) scale(0.100000,-0.100000)">
<path d="M0 3615 l0 -605 605 0 605 0 0 605 0 605 -605 0 -605 0 0 -605z"/>
<path d="M1500 3615 l0 -605 1810 0 1810 0 0 605 0 605 -1810 0 -1810 0 0
-605z"/>
<path d="M0 2110 l0 -610 605 0 605 0 0 610 0 610 -605 0 -605 0 0 -610z"/>
<path d="M1500 2110 l0 -610 1810 0 1810 0 0 610 0 610 -1810 0 -1810 0 0
-610z"/>
<path d="M0 605 l0 -605 605 0 605 0 0 605 0 605 -605 0 -605 0 0 -605z"/>
<path d="M1500 605 l0 -605 1810 0 1810 0 0 605 0 605 -1810 0 -1810 0 0 -605z"/>
</g>
</svg>
<!-- Icon filled galeria -->
<svg viewBox="0 0 512.000000 392.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,392.000000) scale(0.100000,-0.100000)">
<path d="M0 3015 l0 -905 755 0 755 0 0 905 0 905 -755 0 -755 0 0 -905z"/>
<path d="M1800 3015 l0 -905 760 0 760 0 0 905 0 905 -760 0 -760 0 0 -905z"/>
<path d="M3610 3015 l0 -905 755 0 755 0 0 905 0 905 -755 0 -755 0 0 -905z"/>
<path d="M0 905 l0 -905 755 0 755 0 0 905 0 905 -755 0 -755 0 0 -905z"/>
<path d="M1800 905 l0 -905 760 0 760 0 0 905 0 905 -760 0 -760 0 0 -905z"/>
<path d="M3610 905 l0 -905 755 0 755 0 0 905 0 905 -755 0 -755 0 0 -905z"/>
</g>
</svg>

<!-- Icon cancelar -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M252 4867 c-138 -138 -252 -257 -252 -262 0 -6 458 -468 1017 -1027
l1018 -1018 -1018 -1018 c-559 -559 -1017 -1022 -1017 -1027 0 -13 502 -515
515 -515 6 0 468 458 1027 1017 l1018 1018 1018 -1018 c559 -559 1022 -1017
1027 -1017 13 0 515 502 515 515 0 6 -458 468 -1017 1027 l-1018 1018 1018
1018 c559 559 1017 1021 1017 1027 0 13 -502 515 -515 515 -5 0 -468 -458
-1027 -1017 l-1018 -1018 -1018 1018 c-559 559 -1022 1017 -1027 1017 -6 0
-124 -114 -263 -253z"/>
</g>
</svg>

<!-- Icon cancelar b -->
<svg class="quitar_filtros" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M681 5104 c-211 -57 -381 -236 -426 -449 -19 -89 -19 -161 0 -250 32
-154 26 -145 795 -1025 391 -446 710 -815 710 -820 0 -5 -319 -374 -710 -820
-602 -688 -715 -822 -745 -883 -116 -236 -72 -504 114 -687 121 -120 246 -170
423 -170 147 0 279 49 395 147 11 10 312 351 668 758 356 407 651 740 655 740
4 0 299 -333 655 -740 356 -407 657 -748 668 -758 116 -98 248 -147 395 -147
178 0 301 50 423 170 186 184 230 451 114 687 -30 61 -143 195 -745 883 -391
446 -710 815 -710 820 0 5 319 374 710 820 602 688 715 822 745 883 116 236
72 503 -114 687 -121 120 -246 170 -421 170 -145 0 -252 -36 -362 -121 -34
-26 -317 -342 -703 -784 -356 -407 -651 -740 -655 -740 -4 0 -299 333 -655
740 -386 442 -669 758 -703 784 -64 49 -139 87 -215 107 -67 18 -237 17 -306
-2z"/>
</g>
</svg>

<!-- Icon filled add -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M2310 5114 c-447 -54 -825 -190 -1167 -420 -164 -110 -255 -185 -393
-324 -139 -138 -214 -229 -324 -393 -204 -302 -340 -651 -403 -1032 -26 -158
-26 -612 0 -770 63 -381 199 -730 403 -1032 110 -164 185 -255 324 -393 138
-139 229 -214 393 -324 302 -204 651 -340 1032 -403 88 -14 166 -18 385 -18
219 0 297 4 385 18 381 63 730 199 1032 403 164 110 255 185 393 324 139 138
214 229 324 393 204 302 340 651 403 1032 26 158 26 612 0 770 -63 381 -199
730 -403 1032 -110 164 -185 255 -324 393 -138 139 -229 214 -393 324 -295
199 -631 332 -1002 398 -85 15 -169 20 -370 23 -143 1 -276 1 -295 -1z m500
-1789 l0 -515 515 0 515 0 0 -250 0 -250 -515 0 -515 0 0 -515 0 -515 -250 0
-250 0 0 515 0 515 -515 0 -515 0 0 250 0 250 515 0 515 0 0 515 0 515 250 0
250 0 0 -515z"/>
</g>
</svg>


<!-- Icon check-b -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M416 5105 c-189 -52 -351 -215 -401 -405 -22 -83 -22 -4197 0 -4280
51 -192 213 -354 405 -405 83 -22 4197 -22 4280 0 192 51 354 213 405 405 22
83 22 4197 0 4280 -51 192 -213 354 -405 405 -79 21 -4208 21 -4284 0z m3877
-727 c60 -26 63 -28 122 -88 41 -40 83 -110 92 -150 13 -59 17 -133 11 -181
-7 -55 -45 -145 -73 -173 -22 -22 -135 -165 -135 -171 0 -3 -8 -13 -17 -23
-19 -19 -104 -118 -138 -159 -11 -14 -27 -33 -35 -42 -19 -21 -66 -79 -86
-106 -31 -42 -130 -161 -153 -182 -13 -13 -21 -23 -17 -23 6 0 -31 -45 -76
-92 -10 -10 -18 -21 -18 -26 0 -4 -9 -13 -21 -20 -12 -7 -19 -16 -16 -18 3 -3
-5 -15 -17 -28 -38 -40 -66 -76 -66 -85 0 -5 -4 -11 -9 -13 -4 -1 -32 -32 -62
-68 -29 -36 -57 -66 -61 -68 -4 -2 -8 -10 -8 -18 0 -8 -3 -14 -8 -14 -4 0 -32
-32 -62 -72 -30 -40 -66 -84 -80 -98 -14 -15 -38 -44 -55 -64 -16 -21 -34 -43
-40 -50 -52 -60 -143 -171 -180 -221 -17 -21 -37 -46 -45 -55 -8 -9 -31 -35
-50 -59 -19 -24 -46 -55 -60 -70 -52 -57 -77 -88 -132 -162 -31 -42 -73 -92
-94 -113 -20 -20 -34 -36 -30 -36 4 0 1 -6 -6 -14 -34 -35 -78 -86 -78 -91 0
-3 -8 -13 -17 -23 -39 -40 -83 -92 -83 -97 0 -3 -8 -13 -17 -24 -21 -21 -57
-65 -93 -112 -14 -18 -31 -38 -38 -45 -6 -7 -12 -15 -12 -18 0 -3 -21 -28 -47
-56 -27 -29 -60 -70 -75 -92 -15 -22 -37 -49 -49 -59 -12 -10 -19 -19 -15 -19
4 0 -7 -13 -24 -30 -16 -16 -30 -32 -30 -34 0 -3 -12 -18 -28 -34 -15 -16 -39
-45 -54 -65 -46 -59 -161 -110 -248 -110 -65 0 -220 53 -220 75 0 4 -7 8 -15
8 -8 0 -15 4 -15 8 0 4 -45 55 -101 112 -55 58 -121 130 -147 160 -26 30 -71
78 -100 107 -28 30 -52 56 -52 59 0 3 -29 35 -65 70 -36 36 -65 66 -65 69 0 2
-17 22 -37 44 -21 21 -73 76 -115 122 -42 46 -100 109 -128 139 -52 56 -100
138 -100 169 0 9 -7 26 -15 37 -19 25 -19 91 0 110 8 9 15 27 15 41 0 49 124
223 159 223 6 0 11 4 11 10 0 5 12 13 28 16 15 4 30 12 34 17 3 6 44 12 90 15
132 7 186 -25 328 -189 30 -34 87 -95 125 -135 39 -39 102 -107 140 -149 39
-43 88 -98 110 -121 22 -24 52 -57 67 -74 32 -36 60 -38 81 -8 8 13 31 41 52
63 20 22 55 65 78 95 23 30 62 80 87 110 25 30 52 63 60 74 8 10 29 35 46 55
17 20 39 47 50 60 10 13 28 33 40 45 12 11 41 48 65 81 24 33 57 72 74 87 16
16 26 28 21 28 -5 0 0 8 10 18 11 9 33 35 50 57 16 21 36 47 44 55 33 36 80
92 80 96 0 2 8 13 18 23 48 52 62 69 62 74 0 4 10 17 23 29 12 13 36 42 52 63
26 34 81 98 123 143 6 7 12 16 12 20 0 4 10 19 23 34 12 15 36 43 52 64 17 21
48 57 71 81 23 24 39 43 37 43 -2 0 2 6 9 14 28 29 104 120 112 135 8 14 82
108 96 121 3 3 23 27 44 54 22 26 50 59 63 72 12 13 23 26 23 29 0 3 11 16 24
28 13 12 47 54 77 92 29 39 58 75 65 80 6 6 15 17 20 26 8 14 46 60 119 144
11 13 36 42 55 65 19 24 40 48 45 54 6 6 23 28 38 49 16 21 38 46 50 57 11 11
18 20 14 20 -4 0 1 8 11 18 9 11 31 36 48 58 89 110 146 143 252 144 54 0 87
-6 125 -22z"/>
</g>
</svg>

<!-- Icon lineal add -->
<svg viewBox="0 0 654.000000 655.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,655.000000) scale(0.100000,-0.100000)">
<path d="M2922 6539 c-16 -6 -17 -98 -22 -1450 l-5 -1443 -1435 -1 c-789 0
-1441 -4 -1447 -8 -10 -6 -13 -92 -13 -373 l0 -364 43 -1 c23 -1 46 0 52 1 5
1 17 1 25 1 8 0 24 -1 35 -1 11 0 36 0 55 -1 19 0 44 0 55 1 11 1 27 1 35 0 8
0 24 0 35 0 11 1 27 1 35 1 8 -1 47 -1 85 -1 39 1 76 1 83 0 6 0 20 0 30 0 9
0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 26 1 33 1 36
-2 71 -3 132 -1 14 1 31 1 38 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0 44 0 55
1 11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1
35 0 8 0 24 0 35 0 11 1 27 1 35 1 8 0 47 0 85 0 39 0 76 0 83 -1 6 0 20 0 30
0 9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 27 1 35 1
8 -1 47 -1 85 -1 39 1 76 1 83 0 6 0 20 0 30 0 9 0 33 0 52 -1 19 0 44 0 55 1
11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35
0 8 0 24 0 35 0 11 1 27 1 35 1 8 0 47 0 85 0 39 0 76 0 83 -1 6 0 20 0 30 0
9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 27 1 35 1 8
-1 43 -2 78 -2 l62 -1 0 -1447 0 -1446 368 0 367 0 3 1448 c2 1369 3 1447 20
1448 9 1 22 0 27 -1 6 -2 19 -2 30 -1 11 1 27 2 35 2 8 0 47 0 85 0 39 0 76 0
83 -1 6 0 20 0 30 0 9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35 0 8 0 24 0
35 0 11 1 27 1 35 1 8 -1 47 -1 85 -1 39 1 76 1 83 0 6 0 20 0 30 0 9 0 33 0
52 -1 19 0 44 0 55 1 11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0 44
0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 27 1 35 1 8 0 47 0 85 0 39 0 76 0
83 -1 6 0 20 0 30 0 9 0 33 0 52 -1 19 0 44 0 55 1 11 1 27 1 35 0 8 0 24 0
35 0 11 1 27 1 35 1 8 -1 47 -1 85 -1 39 1 76 1 83 0 6 0 20 0 30 0 9 0 33 0
52 -1 19 0 44 0 55 1 11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0 44
0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33
0 52 -1 19 0 44 0 55 1 11 1 26 1 33 1 6 -1 20 -1 30 -1 9 0 33 0 52 -1 19 0
44 0 55 1 11 1 27 1 35 0 8 0 24 0 35 0 11 1 27 1 35 1 67 -4 152 -2 157 3 3
3 13 2 22 -3 9 -5 25 -5 36 -1 11 4 33 4 50 0 17 -4 39 -4 50 0 11 4 27 4 36
-1 10 -5 23 -3 33 4 15 11 16 47 14 377 l-3 365 -1445 0 -1445 0 -5 1449 -5
1450 -348 0 c-191 1 -355 -2 -365 -5z"/>
</g>
</svg>
<!-- Icon filled check -->
<svg viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)">
<path d="M2310 5114 c-447 -54 -825 -190 -1167 -420 -164 -110 -255 -185 -393
-324 -139 -138 -214 -229 -324 -393 -204 -302 -340 -651 -403 -1032 -26 -158
-26 -612 0 -770 63 -381 199 -730 403 -1032 110 -164 185 -255 324 -393 138
-139 229 -214 393 -324 302 -204 651 -340 1032 -403 88 -14 166 -18 385 -18
219 0 297 4 385 18 381 63 730 199 1032 403 164 110 255 185 393 324 139 138
214 229 324 393 204 302 340 651 403 1032 26 158 26 612 0 770 -63 381 -199
730 -403 1032 -110 164 -185 255 -324 393 -138 139 -229 214 -393 324 -295
199 -631 332 -1002 398 -85 15 -169 20 -370 23 -143 1 -276 1 -295 -1z m883
-2676 l-1148 -1148 -635 635 -635 635 175 175 175 175 462 -462 463 -463 972
972 973 973 172 -172 173 -173 -1147 -1147z"/>
</g>
</svg>



<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>