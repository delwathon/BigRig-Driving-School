<?php
header("Content-Type:text/css");
$primary = "#f0f"; // Change your Color Here

function checkhexcolor($primary) {
    return preg_match('/^#[a-f0-9]{6}$/i', $primary);
}

if (isset($_GET['primary']) AND $_GET['primary'] != '') {
    $primary = "#" . $_GET['primary'];
}

if (!$primary OR !checkhexcolor($primary)) {
    $primary = "#336699";
}

if (isset($_GET['secondary']) AND $_GET['secondary'] != '') {
    $secondary = "#" . $_GET['secondary'];
}

if (!$secondary OR !checkhexcolor($secondary)) {
    $secondary = "#336699";
}

?>

:root {
    --e-global-color-primary: #28214c;
    --e-global-color-secondary: <?php echo $secondary ?>;
    --e-global-color-accent: <?php echo $primary ?>;
    --e-global-color-text: #777777;
    --e-global-color-very-dark-blue:#010647;
    --e-global-color-very-dark-gray:#555555;
    --e-global-color-very-light-gray: #eeeeee;
    --e-global-color-black:#000000;
    --e-global-color-white: #ffffff;
}

.header .main-menu li a:hover, .header .main-menu li a:focus, .hero__title, .stat-card__icon i, .header .nav-right a, .choose-card__icon,.header .main-menu li.menu_has_children:hover>a::before {
color: <?php echo $primary ?>;
}

.header .main-menu li .sub-menu {
    border-color: <?php echo $primary ?>;
}

.header .main-menu li .sub-menu {
    box-shadow: 0 3px 5px <?php echo $primary ?>;
}

.nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus, .cmn-accordion .card-header .acc-btn, .single-select.active::after,.cookies-card__icon,.copied::after {
background-color: <?php echo $primary ?>;
}

.cmn-btn, .table.style--two thead {
background-color: <?php echo $primary ?>;
}
.cmn-btn:hover {
background-color: <?php echo $primary ?>;
box-shadow: 0 0 10px 2px <?php echo $primary ?>8c;
}
.cmn-btn-two {
    border: 1px solid <?php echo $primary ?>;
}
.cmn-btn-two:hover {
box-shadow: 0px 0px 10px 2px <?php echo $primary ?>bf, inset 0px 0px 10px 2px <?php echo $primary ?>bf;
}
a:hover, .feature-card__icon, .text--base {
color: <?php echo $primary ?>;
}
.choose-card:hover {
    border-color: <?php echo $primary ?>;
    box-shadow: 0 3px 10px <?php echo $primary ?>88;
}

.testimonial-slider .slick-arrow,
.work-card__icon  .step-number {
background-color: <?php echo $primary ?>;
}

.testimonial-card__content,
.testimonial-card__content::before {
    border-color: <?php echo $primary ?>;
}

.post-card__content .date, .work-card__icon i {
color: <?php echo $primary ?>;
}

.footer-widget .subscribe-form .subscribe-btn {
background-color: <?php echo $primary ?>;
}

.info-single__content a:hover {
color: <?php echo $primary ?>;
}

.winner-item:hover {
    border-color: <?php echo $primary ?>;
    box-shadow: 0 0 3px <?php echo $primary ?>60;
}

.scroll-to-top, .post-card__thumb .post-card__date,.table thead tr th {
    background-color: <?php echo $primary ?>;
}


.base--color, .small-post__content .date {
color: <?php echo $primary ?>;
}

.page-list li a {
color: <?php echo $primary ?>;
}

.pagination .page-item .page-link::after, .modal-header {
background-color: <?php echo $primary ?>;
}

.input-group-text {
    background-color: <?php echo $primary ?>;
    border-color: <?php echo $primary ?>;
}

.contact-item i {
color: <?php echo $primary ?>;
}

.contact-item a:hover {
color: <?php echo $primary ?>;
}

.account-wrapper .input-group-text {
background-color: <?php echo $primary ?>;
}

.amount-field ~ .input-group-append .input-group-text {
background-color: <?php echo $primary ?>;
border: 1px solid <?php echo $primary ?>;
}

.base--bg {
background-color: <?php echo $primary ?>;
}


.custom--table .thead-dark th:last-child {
border-right: 1px solid <?php echo $primary ?>;
}

.custom--file-upload ~ label {
background-color: <?php echo $primary ?>;
}

*::-webkit-scrollbar-thumb {
background: <?php echo $primary ?> !important;
}

.page-item.active .page-link {
    color: <?php echo $primary ?> !important;
}

.profile-thumb .avatar-edit label {
background-color: <?php echo $primary ?> !important;
color: #fff !important;
}

.statistics-section {
    border-top: 1px solid <?php echo $primary ?>;
    border-bottom: 1px solid <?php echo $primary ?>;
}

.shape-1,
.shape-2,
.shape-1::before,
.shape-2::before,.login-area .input-group-text,.registration-area .input-group-text,.contact-item:hover {
    background-color: <?php echo $primary ?> !important;
}

.preloader__thumb::after{
    border: 2px solid <?php echo $primary ?>;
}
.form-control:focus{
    box-shadow: 0px 0px 4px <?php echo $primary ?> ;
    border: 0.5px solid <?php echo $primary ?> ;
}

.d-widget-balance .d-widget-icon {
    background-color: <?php echo $primary ?>;
    box-shadow: 0 0 5px <?php echo $primary ?>;
}
.verification-code span{
    border: solid 1px  <?php echo $primary ?> !important;
    color:  <?php echo $primary ?> !important;
}

.winner-item::after{
    border: 2px solid <?php echo $primary ?> !important;
    box-shadow:  0 0 5px 2px <?php echo $primary ?> 73!important;
}
.winner-item::before{
    background-color: <?php echo $primary ?>26 !important;
}