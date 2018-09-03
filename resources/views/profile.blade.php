@extends('layouts.header')
@section('content')
<?php 
 $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
 $currency = array ('Albania Lek','Afghanistan Afghani','Argentina Peso','Aruba Guilder','Australia Dollar','Azerbaijan New Manat','Bahamas Dollar','Barbados Dollar','Bangladeshi taka','Belarus Ruble','Belize Dollar','Bermuda Dollar','Bolivia Boliviano','Bosnia and Herzegovina Convertible Marka','Botswana Pula','Bulgaria Lev','Brazil Real','Brunei Darussalam Dollar','Cambodia Riel','Canada Dollar','Cayman Islands Dollar','Chile Peso','China Yuan Renminbi','Colombia Peso','Costa Rica Colon','Croatia Kuna','Cuba Peso','Czech Republic Koruna','Denmark Krone','Dominican Republic Peso','East Caribbean Dollar','Egypt Pound','El Salvador Colon','Estonia Kroon','Euro Member Countries','Falkland Islands (Malvinas) Pound','Fiji Dollar','Ghana Cedis','Gibraltar Pound','Guatemala Quetzal','Guernsey Pound','Guyana Dollar','Honduras Lempira','Hong Kong Dollar','Hungary Forint','Iceland Krona','India Rupee','Indonesia Rupiah','Iran Rial','Isle of Man Pound','Israel Shekel','Jamaica Dollar','Japan Yen','Jersey Pound','Kazakhstan Tenge','Korea (North) Won','Korea (South) Won','Kyrgyzstan Som','Laos Kip','Latvia Lat','Lebanon Pound','Liberia Dollar','Lithuania Litas','Macedonia Denar','Malaysia Ringgit','Mauritius Rupee','Mexico Peso','Mongolia Tughrik','Mozambique Metical','Namibia Dollar','Nepal Rupee','Netherlands Antilles Guilder','New Zealand Dollar','Nicaragua Cordoba','Nigeria Naira','Norway Krone','Oman Rial','Pakistan Rupee','Panama Balboa','Paraguay Guarani','Peru Nuevo Sol','Philippines Peso','Poland Zloty','Qatar Riyal','Romania New Leu','Russia Ruble','Saint Helena Pound','Saudi Arabia Riyal','Serbia Dinar','Seychelles Rupee','Singapore Dollar','Solomon Islands Dollar','Somalia Shilling','South Africa Rand','Sri Lanka Rupee','Sweden Krona','Switzerland Franc','Suriname Dollar','Syria Pound','Taiwan New Dollar','Thailand Baht','Trinidad and Tobago Dollar','Turkey Lira','Turkey Lira','Tuvalu Dollar','Ukraine Hryvna','United Kingdom Pound','United States Dollar','Uruguay Peso','Uzbekistan Som','Venezuela Bolivar','Viet Nam Dong','Yemen Rial','Zimbabwe Dollar');
 $gender = array('Male','Female');
 $m_status = array('Single', 'Married', 'In a realationship');
 $lang = array('Arabic','Chinese', 'English','Hindi','Spanish','French');
 $emp_status = array('Student','Part time Job','Full time Job','Not Employed');
?>
<style>
h3{
    color:white;
}
ul li{
    list-style:none;
}
#snav{
    width:100%;
    margin-left:-40px;
    margin-bottom:2px;
}
</style>
@extends('layouts.side')
<div class="tab-content" id="myTabContent">
<!-- #######################   Profile Division      #################### -->
<div class="col-md-9 tab-pane fade in active" style="background-color: white;height: auto; min-height:105vh;" id="profile">
<br>
<table class="table">
    <thead>
      <tr style="background-color:wheat; color:#660033;">
        <th>User's Details</th>
        <th></th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <td>Username</td>
        <td>{{ Auth::user()->username }}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{ Auth::user()->email }}</td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>{{ $gender[Auth::user()->gender] }}</td>
      </tr>
      <tr>
        <td>Matrital Status</td>
        <td>{{ $m_status[Auth::user()->maritial_status] }}</td>
      </tr>
      <tr>
        <td>Country</td>
        <td>{{ $countries[Auth::user()->country] }}</td>
      </tr>
      <tr>
        <td>Language</td>
        <td>{{ $lang[Auth::user()->language_id] }}</td>
      </tr>
      <tr>
        <td>Place</td>
        <td>{{ Auth::user()->place }}</td>
      </tr>
      <tr>
        <td>Currency</td>
        <td>{{ $currency[Auth::user()->currency_id] }}</td>
      </tr>
      <tr>
        <td>Date of Birth</td>
        <td>{{ Auth::user()->dob }}</td>
      </tr>
      <tr>
        <td>Employment Status</td>
        <td>{{ $emp_status[Auth::user()->employment_id] }}</td>
      </tr>
      <tr>
        <td>Mail Notification</td>
        <td>@if (Auth::user()->receive_mail_notify)
        <p style="color:green;"><strong> ON </strong></p>
            @else
        <p style="color:red;"><strong> OFF </strong></p>
            @endif
        </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
@endsection