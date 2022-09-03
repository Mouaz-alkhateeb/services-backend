<div wire:poll>
    <div class="container p-0">

		<div class="card">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">

					<div class="px-4 d-none d-md-block">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
                           
								<input type="text" class="form-control my-3" placeholder="بحث...">
                               
							</div>
						</div>
					</div>
                    @foreach ($users as $item)
					<li type="button" wire:click="startChat({{ $item->id }})" class="chat-members list-group-item list-group-item-action border-0">

                        @php
                        // get notifcations/un read messages
                        $notifications = App\Message::where('is_read', '0')->where('sender_id', $item->id)->get();
                        @endphp

						<div class="d-flex align-items-start">
                        <img src="{{ asset('assets/img/faces/1.jpg') }}" class="rounded-circle mr-1"  width="40" height="40">
							<div class="flex-grow-1 ml-3">
								<strong style="text-transform:capitalize">{{ $item->name}}
                                    @if ($notifications->count() > 0)
                                    <small><span class="badge badge-danger text-light float-right mt-2">{{ $notifications->count() }}</span></small>
                                    @endif
                                </strong>
                               

							</div>

						</div>
					</li>
                    @endforeach
					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
				<div class="col-12 col-lg-7 col-xl-9 chat-box">
                    @if ($noChat)
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
                            <img src="{{ asset('assets/img/faces/1.jpg') }}" class="rounded-circle mr-1"  width="40" height="40">
							</div>

							<div class="flex-grow-1 pl-3">
                                <div class="row" style="width: 50%">
                                    <div class="col-10">
                                        <strong style="text-transform: capitalize">{{ $current->name}}</strong>
                                       
                                    </div>
                                    <span class="btn-group-vertical">
                                      
                                        @if ($current->friends == null)
                                        <i wire:click="addFriend({{ $current->id }})" title="Add to friends" class="btn btn-sm text-dark btn-outline-light fa fa-plus"></i>
                                        @else
                                        <i wire:click="removeFriend({{ $current->id }})" title="Remove to friends" class="btn btn-sm text-success btn-outline-light fa fa-check"></i>
                                        @endif
                                    </span>
                                </div>



							</div>
							<div>
                                <button wire:click="clearChats" onclick="confirm('Are you sure of clearing chats?')" class="btn btn-light border px-3" title="Clear Chats"><span class="fa fa-trash"></span></button>
								<a wire:click="back" class="btn btn-light border px-3" title="Logout"><span class="fa fa-sign-out"></span></a>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4" id="content_to_scroll">
                            @if ($messages->count())
                             @foreach ($messages as $chat)
                                @if ($chat->sender_id == Auth::user()->id && $chat->receiver_id == $receiver)
                                <div class="chat-message-right pb-4">
                                    @if ($chat->message == '0')
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <small class="text-muted" style="font-style: italic;">Message Deleted</small>
                                    </div>
                                    @else
                                    <div>
                                    <img src="{{ asset('assets/img/faces/2.jpg') }}" class="rounded-circle mr-1"  width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">{{ date('h:i a', strtotime($chat->created_at)) }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="min-width: 100px">
                                        {{ $chat->message }}
                                        <span class="btn-group btn-block justify-content-between mb-0">
                                           
                                            <i wire:click="deleteMessage({{ $chat->id }})" type="button" class="fa fa-trash text-danger icon"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                @elseif($chat->sender_id == $receiver && $chat->receiver_id == Auth::user()->id)

                                <div class="chat-message-left pb-4">
                                    @if ($chat->message == '0')
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <small class="text-muted" style="font-style: italic;">رسالة محذوفة</small>
                                    </div>
                                    @else
                                    <div>
                                    <img src="{{ asset('assets/img/faces/1.jpg') }}" class="rounded-circle mr-1"  width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">{{ date('h:i a', strtotime($chat->created_at)) }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 pb-0 px-3 ml-3" style="min-width: 100px">
                                        {{ $chat->message }}
                                        <br>
                                        <span class="btn-group btn-block justify-content-between">
                                           
                                            <i wire:click="deleteMessage({{ $chat->id }})" type="button" class="fa fa-trash text-danger icon"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                             @endforeach
                            @else
                                <div style="min-height: auto">
                                    <p class="no-chat-yet">...لا توجد محادثات </p>
                                </div>
                            @endif
						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
						<form wire:submit.prevent="sendChat">
                            <div class="input-group">
                                <input type="hidden" value="{{ $receiver }}" wire:model.defer="receiver_id">
                                <input onfocus="myFunction()" autofocus type="text" class="form-control @error('message') is-invalid @enderror" wire:model.defer="message" placeholder="اكتب رسالة ">
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text"><i class="fa fa-send"></i></button>
                                </div>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
					</div>
                    @else
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">

                            <img src="{{ asset('assets/img/faces/2.jpg') }}" class="rounded-circle mr-1"  width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong style="text-transform: capitalize">{{ Auth::user()->name }}</strong>
								<div class="text-muted small">إختر مستخدم لبدء المحادثة</div>
							</div>
						</div>
					</div>
                    @endif

				</div>
                
			</div>
            
		</div>
        <div class="d-flex justify-content-center">
          <a wire:click="back1" type="button" class="text-center form-control my-3"  title="backto"  style=" background-color: #ccccb3 !important; width : 30% !important"> عودة للصفحة الرئيسية</a>     
        </div>
       
	</div>
</div>
