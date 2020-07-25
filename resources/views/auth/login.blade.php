@extends('layouts/app')

@section('css-page')
    <link href="{{ asset('css/pages-style.css') }}" rel="stylesheet">
@endsection

@section('content')
    
<div id="all">
    <header class=" login-header">
        <div class="background">
            <img src="images/social-green-icon.png" alt="">
            <p>Sanagel Club</p>
            <section class="fix"></section>
        </div>
    </header>
    <section class="fix"></section>
    <div class="form">
        <div class="formom">
            <form class="signup-form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <input type="hidden" name="sign_up" value="TRUE">
                <h1>Create a new account</h1>

                <div class="input half-width half">
                    <input type="text" required name="fname" autocomplete="off">
                    <label for="first-name">First Name: </label>
                    <span></span>
                </div>

                <div class="input half-width">
                    <input type="text" required name="lname" autocomplete="off">
                    <label for="last-name">Last Name: </label>
                    <span></span>
                </div>

                <section class="fix"></section>

                <div class="input">
                    <input type="text" name="email" required autocomplete="off">
                    <label for="email">Email or Phone Number: </label>
                    <span></span>
                </div>

                <div class="input">
                    <input type="password" minlength="6" required name="password" autocomplete="off">
                    <label for="password">Password: </label>
                    <span></span>
                </div>

                <div class="input">
                    <input type="password" min="1" required name="password_confirmation" autocomplete="off">
                    <label for="confirm-password">Confirm Password: </label>
                    <span></span>
                </div>

                <div class="birthday">
                    <label class="label" for="day">Day: </label>
                    <select name="day" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <label class="label" for="month">Month: </label>
                    <select name="month" id="">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                    <label class="label" for="year">Year: </label>
                    <select name="year" id="">
                        <option value="1950">1950</option>
                        <option value="1951">1951</option>
                        <option value="1952">1952</option>
                        <option value="1953">1953</option>
                        <option value="1954">1954</option>
                        <option value="1955">1955</option>
                        <option value="1956">1956</option>
                        <option value="1957">1957</option>
                        <option value="1958">1958</option>
                        <option value="1959">1959</option>
                        <option value="1960">1960</option>
                        <option value="1961">1961</option>
                        <option value="1962">1962</option>
                        <option value="1963">1963</option>
                        <option value="1964">1964</option>
                        <option value="1965">1965</option>
                        <option value="1966">1966</option>
                        <option value="1967">1967</option>
                        <option value="1968">1968</option>
                        <option value="1969">1969</option>
                        <option value="1970">1970</option>
                        <option value="1971">1971</option>
                        <option value="1972">1972</option>
                        <option value="1973">1973</option>
                        <option value="1974">1974</option>
                        <option value="1975">1975</option>
                        <option value="1976">1976</option>
                        <option value="1977">1977</option>
                        <option value="1978">1978</option>
                        <option value="1979">1979</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998" selected>1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                    </select>
                    <section class="fix"></section>
                </div>
                <section class="fix"></section>
                <div class="gender">
                    <label>Gender: </label>
                    <input class="radio" type="radio" name="gender" value="Male">
                    <p>Male</p>
                    <input type="radio" class="radio" name="gender" value="Female">
                    <p>Female</p>
                </div>
                <span id="hr"></span>
                <button type="submit" name="signup" class="signup" id="sign-btn">Sign up</button>
                <div class="have-account"><a onclick="rotatee()" href="#" >I have an account</a></div>
            </form>

            <form class="login-form" id="loginForm" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <input type="hidden" name="sign_in" value="TRUE">
                <h1>Sign in to your account</h1>
                <section class="fix"></section>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="input">
                        <input type="text" name="email" id="email" required autocomplete="off">
                        <label for="email">Email or Phone Number: </label>
                        <span></span>

                        {{-- @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif --}}
                    </div>
                    

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="input">
                        <input type="password" required name="password" id="password" autocomplete="off">
                        <label for="password">Password: </label>
                        <span></span>
                        
                    </div>
                </div>
                

                
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
                <button type="submit" name="signin" class="signin" id="log-btn">Sign in</button>
                <div class="have-account"><a onclick="rotate()" href="#">Create an account</a></div>
            </form>
        </div>
    </div>

@endsection
