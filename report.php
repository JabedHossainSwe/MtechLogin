<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


    <title>Dashboard</title>

    <style>
		.direction {
			<?php if ($lang == 1) {
				echo " direction: ltr;";
			} else {
				echo "direction: rtl;";
			} ?>
		}

		.direction-ltr {
			direction: ltr !important;
		}

		.direction-rtl {
			direction: rtl !important;
		}
	</style>
</head>

<body class="top-navigation">

    <div id="wrapper" class="direction">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg justify-content-between">
                <?php
                include("header.php");
                ?>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading pb-2">
                <div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="float-left en">Sales Return Report (Detail)</span><span class="float-right ar"><?= getArabicTitle('Sales Return Report (Detail)') ?></span></h2>

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row mb-1">
                    <div class="col-md-6 col-8">
                        <button type="button" class="btn btn-w-m btn-default eng">English</button>
                        <button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
                    </div>
                    <div class="col-md-6 col-4">
                        <button type="button" class="btn btn-w-m btn-success float-right" id="filter">Filters</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title no_envent" style="display:none">
                                <h5>Filters</h5>
                                <div class="ibox-tools" style="display: none">
                                    <a class="collapse-link filter_act">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                            <form class="ibox-content filter_container" style="display:none">

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"><span class="font-weight-bold en">Branch</span><span class="font-weight-bold ar">فرع</span></label>
                                            <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="2">
                                                <option value="">Select</option>
                                                <option value="United States">United States</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Aland Islands">Aland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curacao">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-bissau">Guinea-bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>

                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russian Federation">Russian Federation</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                                <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                <option value="South Sudan">South Sudan</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-leste">Timor-leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                                <option value="Viet Nam">Viet Nam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"><span class="font-weight-bold en">Purchase Bill No.</span><span class="font-weight-bold ar">رقم فاتورة الشراء</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Bill No. From</span><span class="ar">رقم الفاتورة من</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Bill No. To</span><span class="ar">رقم الفاتورة</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Supplier</span><span class="ar">المورد</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Bill Data From</span><span class="ar">بيانات الفاتورة من</span></label>
                                            <div class="row">
                                                <div class="i-checks col-3 p-0 d-flex justify-content-center align-items-center">
                                                    <input type="checkbox" id="checkbox1">
                                                </div>
                                                <div class="input-group date col-8 p-0">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" value="03/04/2014">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">From Time</span><span class="ar">من وقت</span></label>

                                            <div class="row">
                                                <div class="i-checks col-3 p-0 d-flex justify-content-center align-items-center">
                                                    <input type="checkbox" id="checkbox1">
                                                </div>
                                                <div class="input-group clockpicker col-8 p-0">
                                                    <input type="text" class="form-control" value="09:30">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Bill Data To</span><span class="ar">فاتورة البيانات إلى</span></label>
                                            <div class="row">
                                                <div class="i-checks col-3 p-0 d-flex justify-content-center align-items-center">
                                                    <input type="checkbox" id="checkbox1">
                                                </div>
                                                <div class="input-group date col-8 p-0">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" value="03/04/2014">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">To Time</span><span class="ar">الى وقت</span></label>

                                            <div class="row">
                                                <div class="i-checks col-3 p-0 d-flex justify-content-center align-items-center">
                                                    <input type="checkbox" id="checkbox1">
                                                </div>
                                                <div class="input-group clockpicker col-8 p-0">
                                                    <input type="text" class="form-control" value="09:30">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Customer From</span><span class="ar">زبون من</span></label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Customer To</span><span class="ar">العميل ل</span></label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Item Code From</span><span class="ar">رمز العنصر من</span></label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Item Code To</span><span class="ar">رمز العنصر إلى</span></label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label"><span class="en">Users</span><span class="ar">المستخدمون</span></label>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><span class="en">Salesman</span><span class="ar">بائع</span></label>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><span class="en">Item Group</span><span class="ar">مجموعة العناصر</span></label>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea name="" id="" cols="30" rows="7"></textarea>
                                                    <div class="row pt-4 pb-1">
                                                        <div class="col-md-6"><button type="button" class="btn btn-block btn-w-m btn-success"><span class="en">Add Product List</span><span class="ar">أضف قائمة المنتجات</span></button></div>
                                                        <div class="col-md-6"><button type="button" class="btn btn-block btn-w-m btn-danger"><span class="en">Clear Product List</span><span class="ar">قائمة المنتجات واضحة</span></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><span class="en">Post Name</span><span class="ar">اسم الوظيفة</span></label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label"><span class="en">Amount</span><span class="ar">مقدار</span></label>
                                                    <div class="row">
                                                        <div class="col-6 pr-0">
                                                            <select class="form-control m-b text-weight-bold" name="account">
                                                                <option>232</option>
                                                                <option>232</option>
                                                                <option>232</option>
                                                                <option>232</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row mt-4 pt-2">
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">All</span><span class="ar">الجميع</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green " style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">With GST</span><span class="ar">مع ضريبة السلع والخدمات</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Without GST</span><span class="ar">بدون ضريبة السلع والخدمات</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row mt-4 pt-2">
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">General</span><span class="ar">عام</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green " style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Details</span><span class="ar">تفاصيل</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Product Group</span><span class="ar">مجموعة المنتجات</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row mt-4 pt-2">
                                                    <div class="col-3">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Cash</span><span class="ar">نقدي</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green " style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Credit</span><span class="ar">تنسب إليه</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">Temp</span><span class="ar">مؤقت</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="i-checks"><label class="">
                                                                <div class="iradio_square-green" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                </div> <i></i> <span class="en">All</span><span class="ar">الجميع</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row justify-content-center mt-5">
                                            <div class="col-md-3"><button type="button" class="btn btn-block btn-lg btn-danger"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
                                                </button>
                                            </div>
                                            <div class="col-md-3"><button type="button" class="btn btn-block btn-lg btn-success"><span class="en">Search</span><span class="ar">البحث </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content this_ar">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="c_width"><span class="en">Customer</span><span class="ar">عميل</span></th>
                                                <th><span class="en">Total</span><span class="ar">المجموع</span></th>
                                                <th><span class="en">Discount</span><span class="ar">تخفيض</span></th>
                                                <th><span class="en">Discount%</span><span class="ar">تخفيض٪</span></th>
                                                <th><span class="en">Net Total</span><span class="ar">صافي الإجمالي</span></th>
                                                <th><span class="en">GST Totla</span><span class="ar">ضريبة السلع والخدمات توتلا</span></th>
                                                <th><span class="en">Grand Total</span><span class="ar">المبلغ الإجمالي</span></th>
                                                <th><span class="en">Inv Type</span><span class="ar">نوع الفاتورة</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr>
                                                <td><span class="text-warp">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </span></td>
                                                <td>Total</td>
                                                <td>Discount</td>
                                                <td>Discount%</td>
                                                <td>Net Total</td>
                                                <td>GST Totla</td>
                                                <td>Grand Total</td>
                                                <td>Inv Type</td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-warp">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </span></td>
                                                <td>Total</td>
                                                <td>Discount</td>
                                                <td>Discount%</td>
                                                <td>Net Total</td>
                                                <td>GST Totla</td>
                                                <td>Grand Total</td>
                                                <td>Inv Type</td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-warp">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </span></td>
                                                <td>Total</td>
                                                <td>Discount</td>
                                                <td>Discount%</td>
                                                <td>Net Total</td>
                                                <td>GST Totla</td>
                                                <td>Grand Total</td>
                                                <td>Inv Type</td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-warp">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </span></td>
                                                <td>Total</td>
                                                <td>Discount</td>
                                                <td>Discount%</td>
                                                <td>Net Total</td>
                                                <td>GST Totla</td>
                                                <td>Grand Total</td>
                                                <td>Inv Type</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><span class="en">Customer</span><span class="ar">عميل</span></th>
                                                <th><span class="en">Total</span><span class="ar">المجموع</span></th>
                                                <th><span class="en">Discount</span><span class="ar">تخفيض</span></th>
                                                <th><span class="en">Discount%</span><span class="ar">تخفيض٪</span></th>
                                                <th><span class="en">Net Total</span><span class="ar">صافي الإجمالي</span></th>
                                                <th><span class="en">GST Totla</span><span class="ar">ضريبة السلع والخدمات توتلا</span></th>
                                                <th><span class="en">Grand Total</span><span class="ar">المبلغ الإجمالي</span></th>
                                                <th><span class="en">Inv Type</span><span class="ar">نوع الفاتورة</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-between mt-5 mb-3">
                            <div class="col-md-2"><button type="button" class="btn btn-block btn-lg btn-danger">
                                    <span class="en">Previous Page</span>
                                    <span class="ar">الصفحة السابقة</span>

                                </button>
                            </div>
                            <div class="col-md-2"><button type="button" class="btn btn-block btn-lg btn-success">
                                    <span class="en">Next Page</span>
                                    <span class="ar">الصفحة التالية</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include("footer.php");
            ?>
        </div>
    </div>

    <script>
        $('.chosen-select').chosen({
            width: "100%"
        });


        $("#filter").on("click", function() {
            $(".filter_act").click();
            $(".no_envent").toggleClass("displayB");
        })
        $(".ara").on("click", function() {
            $("span.en").css("display", "none");
            $("span.ar").css("display", "block");
            $(".add_me").addClass("rv");
            $(".this_ar").addClass("tb");
        })

        $(".eng").on("click", function() {
            $("span.en").css("display", "block");
            $("span.ar").css("display", "none");
            $(".add_me").removeClass("rv");
            $(".this_ar").removeClass("tb");

        })
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'csv'
                    },
                    {
                        extend: 'excel',
                        title: 'ExampleFile'
                    },
                    {
                        extend: 'pdf',
                        title: 'ExampleFile'
                    },

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });
        });

        $('.clockpicker').clockpicker({
            donetext: 'Select Time'
        });

        var mem = $('.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    </script>

</body>

</html>