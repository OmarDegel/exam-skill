<ul class="footer-social">
    @if($setting->facebook !== null)
    <li><a href="{{$setting->facebook}}" target="__blank"  class="facebook"><i class="fa fa-facebook"></i></a></li>
    @endif
    @if($setting->twitter !== null)
    <li><a href="{{$setting->twitter}}" target="__blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
    @endif
    @if($setting->instgram !== null)
    <li><a href="{{$setting->instgram}}" target="__blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
    @endif
    @if($setting->linkedin !== null)
    <li><a href="{{$setting->linkedin}}" target="__blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
    @endif
</ul>