@extends('layouts.default')
@section('content')
<div class="qa-main">
    <h1>
        Flagged content
    </h1>
        <div class="qa-part-q-list">
            <form action="../admin/flagged" method="post">
                <div class="qa-q-list">
                    @foreach($data as $record)
                    <div id="p53" class="qa-q-list-item">
                        <div class="qa-q-item-stats">
                        </div>
                        <div class="qa-q-item-main">
                            <div class="qa-q-item-title">
                                <a href="../53/this-is-quetion-to-check-ip-address">{{$record['title']}}</a>
                            </div>
                            <div class="qa-q-item-content">
                                {{$record['content']}}
                            </div>
                            <span class="qa-q-item-avatar-meta">
                                <span class="qa-q-item-meta">
                                    <span class="qa-q-item-what">asked</span>
                                    <span class="qa-q-item-when">
                                            <span class="qa-q-item-when-data">2 days</span><span class="qa-q-item-when-pad"> ago</span>
                                    </span>
                                    <span class="qa-q-item-who">
                                            <span class="qa-q-item-who-pad">by </span>
                                            <span class="qa-q-item-who-data"><a class="qa-ip-link" title="IP address 127.0.0.1" href="../ip/127.0.0.1">{{$record['handle']}}</a></span>
                                    </span>
                                    <span title="? test2">
                                        <span class="qa-q-item-flags">
                                                <span class="qa-q-item-flags-data">{{$record['flagcount']}}</span><span class="qa-q-item-flags-pad"> flag</span>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        <div class="qa-q-item-buttons">
                                <input type="submit" class="qa-form-light-button qa-form-light-button-clearflags" title="" value="clear flags" onclick="return qa_admin_click(this);" name="admin_53_clearflags">
                                <input type="submit" class="qa-form-light-button qa-form-light-button-hide" title="" value="hide" onclick="return qa_admin_click(this);" name="admin_53_hide">
                        </div>
                    </div>
                    <div class="qa-q-item-clear">
                    </div>
                </div> <!-- END qa-q-list-item -->
            @endforeach

       </div> <!-- END qa-q-list -->

        <div class="qa-q-list-form">
                <input type="hidden" value="1-1418646190-e485c64c86a91886832492b073630407a28d5a46" name="code">
        </div>
        </form>
    </div>
</div>
@stop
