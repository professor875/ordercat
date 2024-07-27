<x-layouts.email>
    <!-- Section : Content -->
    <table class="wrapper" cellpadding="0" cellspacing="0" role="presentation" width="100%">
        <tr>
            <td align="center" bgcolor="#F5F5F5">
                <!-- 500px Box -->
                <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="500">
                    <tr>
                        <td class="col px-sm-30 py-sm-30" align="left" bgcolor="#FFFFFF"
                            style="padding:50px 50px 30px 50px;">
                            <!-- Content -->
                            <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                <tr>
                                    <td class="col" width="400"
                                    " align="left">
                                    <h1 class="sm-hero-text"
                                        style="font-family: 'Quicksand', Helvetica, sans-serif ;font-size: 28px;line-height: 28px;font-weight: 400; color:#292929;margin: 0; margin-bottom: 10px;">
                                        Hey, Welcome to
                                    </h1>
                                    <h1 class="sm-hero-text"
                                        style="font-family: 'Quicksand', Helvetica, sans-serif ;font-size: 44px;line-height: 44px;font-weight: 500; color:#292929;margin: 0; margin-bottom: 15px;">
                                        {{config('app.name')}}
                                    </h1>
                                    <div class="spacer py-sm-10" style="line-height: 20px;">‌</div>
                                    <h3 class="sm-hero-text"
                                        style="font-family: 'Quicksand', Helvetica, sans-serif ;font-size: 18px;line-height: 18px;font-weight: 400; color:#292929;margin: 0; margin-bottom: 15px;">
                                        You have been rated <b>{{$stage->instruments_rating}}</b> for the Instruments at the Building <b>{{$stage->orderedFor->title}}</b> by user <b>{{$actor->name}}</b>
                                    </h3>
                                    <h3 class="sm-hero-text"
                                        style="font-family: 'Quicksand', Helvetica, sans-serif ;font-size: 18px;line-height: 18px;font-weight: 400; color:#292929;margin: 0; margin-bottom: 15px;">
                                        And
                                    </h3>
                                    <h3 class="sm-hero-text"
                                        style="font-family: 'Quicksand', Helvetica, sans-serif ;font-size: 18px;line-height: 18px;font-weight: 400; color:#292929;margin: 0; margin-bottom: 15px;">
                                        You have been rated <b>{{$stage->employees_rating}}</b> for the Employees at the Building <b>{{$stage->orderedFor->title}}</b> by user <b>{{$actor->name}}</b>
                                    </h3>
                                </tr>
                            </table>
                            <!-- end Section : content -->
                        </td>
                    </tr>
                </table>
                <!-- end Content -->
            </td>
        </tr>
    </table>
    <!-- end 500px box -->



    <!-- Section : Schedule -->
    <table class="wrapper" cellpadding="0" cellspacing="0" role="presentation" width="100%">
        <tr>
            <td align="center" bgcolor="#F5F5F5">
                <!-- 500px Box -->
                <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="500">
                    <tr>
                        <td class="col px-sm-30 py-sm-20" width="400" align="left" Book Now bgcolor="#FFFFFF"
                            style="padding:15px 50px ;">
                            <!-- Content -->
                            <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                <tr>
                                    <td class="col">

                                        <p style="font-family: 'Karla', Arial, sans-serif;font-size: 12px;line-height: 18px;font-style: italic;font-weight: 400; color:#7E7E7E; margin: 0; margin-bottom: 5px ;">
                                            Please check more detail
                                        </p>
                                        <table>
                                            <tr>
                                                <td class="col pb-sm-10 pr-sm-0" width="190" style="padding-right: 10px;">
                                                    <!-- button -->
                                                    <table class="align-sm-center" cellpadding="0" cellspacing="0"
                                                           role="presentation" width="100%">
                                                        <tr>
                                                            <th bgcolor="#006CF5"
                                                                style="border-radius: 3px; line-height: 100%; mso-padding-alt: 5px 50px 10px;">
                                                                <a href="{{route('stages.show', $stage->id)}}"
                                                                   style="font-family: 'Lato', Arial, sans-serif;color: #FFFFFF;font-weight: 700; display: block; font-size: 14px; padding: 10px 20px; text-decoration: none;">Show
                                                                    More Detail</a>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                            <!-- end Content -->
                        </td>
                    </tr>
                </table>
                <!-- end 500px box -->
            </td>
        </tr>
    </table>
    <!-- end Section : Schedule-->
</x-layouts.email>
