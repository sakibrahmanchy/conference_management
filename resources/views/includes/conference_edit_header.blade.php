<ul class="nav nav-pills {{--@if(isset($bodySize)&&$bodySize==60)--}} col-md-offset-1{{-- @endif--}}" role="tablist">
   <li role="presentation" @if($pageTitle=="basic") class = "active" @endif ><a href="{{route('edit_conference',['conference_id'=>$conference_id])}}">Basic information</a></li>
   <li role="presentation" @if($pageTitle=="dates") class = "active" @endif ><a href="{{route('edit_conference_dates',['conference_id'=>$conference_id])}}">Important Dates</a></li>
   <li role="presentation" @if($pageTitle=="terms") class = "active" @endif><a href="{{route('edit_conference_terms',['conference_id'=>$conference_id])}}">Terms and Policy<span class="badge"></span></a></li>
   <li role="presentation" @if($pageTitle=="speaker") class = "active" @endif ><a href="{{route('speaker_list',['conference_id'=>$conference_id])}}">Speakers <span class="badge"></span></a></li>
   <li role="presentation" @if($pageTitle=="track") class = "active" @endif ><a href="{{route('track_list',['conference_id'=>$conference_id])}}">Tracks & Scopes<span class="badge"></span></a></li>
   <li role="presentation" @if($pageTitle=="committee") class = "active" @endif ><a href="{{route('committee_list',['conference_id'=>$conference_id])}}">Committee<span class="badge"></span></a></li>
   <li role="presentation" @if($pageTitle=="reviewer") class = "active" @endif ><a href="{{route('reviewer_list',['conference_id'=>$conference_id])}}">Reviewers<span class="badge"></span></a></li>
    <li role="presentation" @if($pageTitle=="submissions") class = "active" @endif><a href="{{route("submissions_show",["conference_id"=>$conference_id ])}}" >Submissions</a></li>
    <li role="presentation" @if($pageTitle=="reviews") class = "active" @endif><a href="{{route("submissions_judge",["conference_id"=>$conference_id ])}}" >Reviews</a></li>
</ul>
<br>
