@extends('frontend.layout.default')

@section('title', 'Registration Photographs requirements')

@section('page_title', 'Registration Photographs requirements')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mx-50 fz-15">
                    <p class="">When applying for regisratation you are required to upload a digital photograph taken within the last six months as part of completing and submitting the Form.</p>

                        <h6 class="mt-20 fz-17">Digital Photo Requirements</h6>
                        <p>Your application photo must meet certain criteria regarding size and content. Submitting photos that do not meet these criteria can delay the application process. Digital photos uploaded with your Form must have been taken within the last six months, and must meet the guidelines shown in the image below:</p>

                        <p>If your photo does not meet the requirements, you will be required to submit a new photo before your registration is processed, even if the application system accepted it as a digital photo upload.</p>

                    <div>
                        <img class="mx-10" src="{{ asset('assets/website/images/image_dimensions.jpg') }}" alt="">
                    </div>

                    <h6 class="mt-20 fz-17">Head Size</h6>

                    <p>Your head height, measured from the top of your head, including the hair, to the bottom of your chin, must be between 50% and 70% of the photo’s total height. Your eye height, measured from the bottom of the photo to the level of your eyes, should be between 55% and 70% - or roughly 2/3 - of the photo’s height.</p>

                    <h6 class="mt-20 fz-17">Eyeglasses</h6>

                    <p>Eye glasses not allowed in registration photos.</p>

                    <h6 class="mt-20 fz-17">Photo Dimensions</h6>
                    <p>Your photo must be square-shaped, meaning the photo’s height must be the same as its width. The minimum dimensions for your photo are 600 pixels x 600 pixels (height x width). The maximum dimensions are 1200 pixels x 1200 pixels (height x width).</p>


                    <h6 class="mx-50 fz-20 text-center">7 Steps to Successful Photo</h6>
                    <h6 class="mt-20 fz-17">Head Orientation</h6>
                    <p>head orientation is important when taking your registration photo. Frame yourself within the photo so that your full face shows. Face directly toward the camera and make sure your eyes are open.</p>

                    <h6 class="mt-20 fz-17">Fill the Frame</h6>
                    <p>Your photo must show your entire hrad from the top of your hair to the bottom of your chin. In a good photo, the height of your head will measure 1-1-3/8 inches (25 to 35mm), or fill between 50%-70% of the photo, like this:</p>

                    <div>
                        <img class="mx-10" src="{{ asset('assets/website/images/fill_frame.jpg') }}" alt="">
                    </div>

                    <h6 class="mt-20 fz-17">Stay Centered</h6>
                    <p>Center your head within the frame.</p>

                    <h6 class="mt-20 fz-17">Show Your Eyes</h6>
                    <p>Make sure your eyes are open. Your eyes should be 2/3 of the way up the photo, or between 1-1/8 inches to 1-3/8 inches (28 mm and 35 mm) - about 60% - from the bottom of the photo.</p>

                    <h6 class="mt-20 fz-17">Background</h6>
                    <p>The area behind you in the photo should be uncluttered and either white or off-white. Sit in front of a plain white or off-white background for best results.</p>

                    <h6 class="mt-20 fz-17">Eliminate Shadows</h6>
                    <p>Sit so that your face is fully-lit and there are no distracting shadow across your face or in the background.</p>

                    <h6 class="mt-20 fz-17">Relax and Look Natural</h6>
                    <p>Be sure to have a natural expression on your face when you take your photo, like those shown here:</p>

                    <div>
                        <img class="mt-10 mb-10 mr-10" src="{{ asset('assets/website/images/image_rule_sample_1.jpg') }}" alt="">

                        <img class="mx-10" src="{{ asset('assets/website/images/image_rule_sample_2.jpg') }}" alt="">
                    </div>

                    <p>Do not wear a hat or head covering that obscures the hair or hairline, unless worn daily for a religious purpose. Your full face must be visible, and the head covering must not cast any shadows on your face.</p>

                </div>
            </div>
        </div>
    </div>
@stop
