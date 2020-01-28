<?php include_once('./includes/header.php') ?>
<div class="container-fluid pt-7">
    <div class="row">
        <div class="col-sm-4 border-right webchat-panel">
            <div class="already-chatted">
                <div class="d-flex py-2 justify-content-between">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user.jpg" alt="profile picture">
                        <div>
                            <h4 class="m-0">Chats</h4>

                        </div>
                    </div>
                    <button class="btn body-home rounded"><i class="fas fa-pen text-dark"></i></button>

                </div>

                <div class="d-flex">
                    <span class="rounded-custom-left body-home p-2">
                        <i class="fas fa-search text-secondary"></i>
                    </span>

                    <input type="text" placeholder="Search Chats"
                        class="btn w-100 body-home pl-0 rounded-custom-right text-left">
                </div>

                <div class="d-flex my-3 body-home justify-content-between new-message py-2 px-2 rounded-pill">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-default.png"
                            alt="profile picture">
                        <h6 class="mt-2 font-weight-normal">New message</h6>
                    </div>
                    <div class="my-close d-none">
                        <button type="button" class="btn">
                            <span>&times;</span>
                        </button>
                    </div>
                </div>

                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-6.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">Saint Maria</h6>
                            <p class="text-secondary m-0">Going to school now <span class="see-all">-1:27pm</span></p>
                        </div>
                    </div>

                </div>

                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-3.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">Arjun Marvun</h6>
                            <p class="text-secondary m-0">Hey bruv, how are u duin <span class="see-all">-Mon</span></p>
                        </div>
                    </div>

                </div>

                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">dock duke</h6>
                            <p class="text-secondary m-0">Will meet you there <span class="see-all">-Fri</span></p>
                        </div>
                    </div>

                </div>


                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-6.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">Saint Maria</h6>
                            <p class="text-secondary m-0">Going to school now <span class="see-all">-1:27pm</span></p>
                        </div>
                    </div>

                </div>

                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-3.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">Arjun Marvun</h6>
                            <p class="text-secondary m-0">Hey bruv, how are u duin <span class="see-all">-Mon</span></p>
                        </div>
                    </div>

                </div>

                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">dock duke</h6>
                            <p class="text-secondary m-0">Will meet you there <span class="see-all">-Fri</span></p>
                        </div>
                    </div>

                </div>
                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">dock duke</h6>
                            <p class="text-secondary m-0">Will meet you there <span class="see-all">-Fri</span></p>
                        </div>
                    </div>

                </div>
                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">dock duke</h6>
                            <p class="text-secondary m-0">Will meet you there <span class="see-all">-Fri</span></p>
                        </div>
                    </div>

                </div>
                <div class="friend-suggest px-2 mb-3">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="m-0">dock duke</h6>
                            <p class="text-secondary m-0">Will meet you there <span class="see-all">-Fri</span></p>
                        </div>
                    </div>

                </div>

            </div>


            <div class="webchat-panel position-relative chat-mobile d-none">
                <div class="border-bottom py-2">

                    <!-- <div class="d-none">
                            <span class="mt-1 mr-2 text-secondary">To:</span>
                            <input class="w-100 border-0 see-all" type="text"
                                placeholder="Type the name of the person you want to message">
    
                        </div> -->

                    <div class="friend-suggest px-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="fas fa-arrow-left text-primary w-25"></i>
                            <div class="d-flex bg-dar w-50">
                                <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                                    alt="profile picture">
                                <div class="w-50">
                                    <h5 class="text-primary mt-1">dock duke</h5>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="d-flex flex-column align-items-end chat-space px-2">

                    <div class="py-4 text-right w-100">
                        <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                            Hi, how are you ?
                        </div>
                        <span class="see-all d-inline-block">11:00 pm</span>

                    </div>

                    <div class="py-4 w-100">
                        <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                            i am good, you ?
                        </div>
                        <span class="see-all d-inline-block">11:15 pm</span>

                    </div>


                    <div class="py-4 text-right w-100">
                        <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                            Good too. Lets party today !
                        </div>
                        <span class="see-all d-inline-block">11:00 pm</span>

                    </div>


                    <div class="py-4 w-100">
                        <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                            yipeeeeeeeee !
                        </div>
                        <span class="see-all d-inline-block">11:15 pm</span>

                    </div>



                    <div class="py-4 text-right w-100">
                        <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                            Hi, how are you ?
                        </div>
                        <span class="see-all d-inline-block">11:00 pm</span>

                    </div>

                    <div class="py-4 w-100">
                        <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                            i am good, you ?
                        </div>
                        <span class="see-all d-inline-block">11:15 pm</span>

                    </div>


                    <div class="py-4 text-right w-100">
                        <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                            Good too. Lets party today !
                        </div>
                        <span class="see-all d-inline-block">11:00 pm</span>

                    </div>


                    <div class="py-4 w-100">
                        <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                            yipeeeeeeeee !
                        </div>
                        <span class="see-all d-inline-block">11:15 pm</span>

                    </div>


                </div>


                <div class="chat-box w-100 chat-box bg-white">
                    <button class="btn py-0"><i class="fas fa-photo-video text-primary"></i></button>
                    <textarea type="text" placeholder="Type your message"
                        class="btn py-0 resize-none w-50 body-home see-all rounded-pill text-left"></textarea>
                </div>



            </div>



        </div>



        <div class="col-sm-8 webchat-panel-desktop webchat-panel position-relative">
            <div class="border-bottom py-3">

                <div class="">
                    <span class="mt-1 mr-2 text-secondary">To:</span>
                    <input class="w-100 border-0 see-all" type="text"
                        placeholder="Type the name of the person you want to message">

                </div>

                <div class="friend-suggest px-2 d-none">
                    <div class="d-flex">
                        <img class="status-pic mr-2 rounded-circle" src="assets/images/user-5.jpg"
                            alt="profile picture">
                        <div>
                            <h6 class="mt-2">dock duke</h6>
                        </div>
                    </div>

                </div>

            </div>


            <div id="chat-view" class="d-none flex-column align-items-end chat-space">

                <div class="py-4 text-right w-100">
                    <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                        Hi, how are you ?
                    </div>
                    <span class="see-all d-inline-block">11:00 pm</span>

                </div>

                <div class="py-4 w-100">
                    <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                        i am good, you ?
                    </div>
                    <span class="see-all d-inline-block">11:15 pm</span>

                </div>


                <div class="py-4 text-right w-100">
                    <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                        Good too. Lets party today !
                    </div>
                    <span class="see-all d-inline-block">11:00 pm</span>

                </div>


                <div class="py-4 w-100">
                    <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                        yipeeeeeeeee !
                    </div>
                    <span class="see-all d-inline-block">11:15 pm</span>

                </div>



                <div class="py-4 text-right w-100">
                    <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                        Hi, how are you ?
                    </div>
                    <span class="see-all d-inline-block">11:00 pm</span>

                </div>

                <div class="py-4 w-100">
                    <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                        i am good, you ?
                    </div>
                    <span class="see-all d-inline-block">11:15 pm</span>

                </div>


                <div class="py-4 text-right w-100">
                    <div class="bg-primary chat-bubble text-left d-inline-block rounded-pill text-white">
                        Good too. Lets party today !
                    </div>
                    <span class="see-all d-inline-block">11:00 pm</span>

                </div>


                <div class="py-4 w-100">
                    <div class="bg-secondary text-left chat-bubble d-inline-block rounded-pill text-white">
                        yipeeeeeeeee !
                    </div>
                    <span class="see-all d-inline-block">11:15 pm</span>

                </div>


            </div>


            <div class="chat-box w-100 chat-box bg-white">
                <button class="btn py-0"><i class="fas fa-photo-video text-primary"></i></button>
                <textarea type="text" placeholder="Type your message"
                    class="btn py-0 resize-none w-50 body-home see-all rounded-pill text-left"></textarea>
            </div>



        </div>





    </div>





</div>


<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>