<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<meta name="format-detection" content="telephone=no"/>
		<!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
		{{route('tour-listing')}}  -->
		<style>
		/* Reset styles */
		body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
		body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
		table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
		img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
		#outlook a { padding: 0; }
		.ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
		/* Rounded corners for advanced mail clients only */
		@media all and (min-width: 560px) {
			.container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px;}
		}
		/* Set color for auto links (addresses, dates, etc.) */
		a, a:hover {
			color: #127DB3;
		}
		.footer a, .footer a:hover {
			color: #999999;
		}
		td.paragraph p {
		font-size: 17px;
		font-weight: inherit;
		line-height: 160%;
		border-collapse: collapse;
		border-spacing: 0;
		margin: 0;
		padding: 0;
		padding-top: 25px;
		color: #464646;
		font-family: sans-serif;
		text-align: justify;
		}

		#content_table_1 {
		  font-family: Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		  margin-top: 10px;
		}

		#content_table_1 td, #content_table_1 th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		#content_table_1 th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #04AA6D;
		  color: white;
		}

		#content_table_1 td:nth-child(1) {
		    background-color: #FFFFFF;
		    color: #464646;
		    font-weight: bold;
		}

		#content_table_1 td {
		    padding-top: 10px;
		    padding-bottom: 10px;
		}

		#content_table_1 th.table_heading {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: center;
		    background-color: #000;
		    color: white;
		}

		#content_table_1 td.table_sub_heading {
		    color: #495057;
		    background-color: #e9ecef;
		    border-color: #dee2e6;
		}
		</style>
		<!-- MESSAGE SUBJECT -->
		<title>Email notification</title>
	</head>
	<!-- BODY -->
	<!-- Set message background color (twice) and text color (twice) -->
	<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
		background-color: #F0F0F0;
		color: #464646;"
		bgcolor="#F0F0F0"
		text="#464646">
		<!-- SECTION / BACKGROUND -->
		<!-- Set message background color one again -->
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
			<tr>
				<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
					bgcolor="#F0F0F0">
					<!-- WRAPPER -->
					<!-- Set wrapper width (twice) -->
					<table border="0" cellpadding="0" cellspacing="0" align="center"
						width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
						max-width: 560px;" class="wrapper">
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
								padding-top: 20px;
								padding-bottom: 20px;">
								<a target="_blank" style="text-decoration: none;"
									href="{{route('tour-listing')}}">
									La Perl Tour
								</a>
							</td>
						</tr>
						<!-- End of WRAPPER -->
					</table>
					<!-- WRAPPER / CONTEINER -->
					<!-- Set conteiner background color -->
					<table border="0" cellpadding="0" cellspacing="0" align="center"
						bgcolor="#FFFFFF"
						width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
						max-width: 560px;" class="container">
						<!-- HEADER -->
						<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
								padding-top: 25px;
								color: #464646;
								font-family: sans-serif;" class="header">
								@yield('heading')
							</td>
						</tr>
						<!-- SUBHEADER -->
						<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 18px; font-weight: 300; line-height: 150%;
								padding-top: 5px;
								color: #464646;
								font-family: sans-serif;" class="subheader">
								@yield('sub_heading')
							</td>
						</tr>
						<!-- HERO IMAGE -->
						{{-- <tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
								padding-top: 20px;" class="hero">
								<a target="_blank" style="text-decoration: none;"
									href="{{route('tour-listing')}}">
									<img border="0" vspace="0" hspace="0"
									src="http://localhost/518430-riches-boom/public/upload_files/uploads/1629355702288426825611dfeb660fdc.jpg"
									alt="Please enable images to view this content" title="Hero Image"
									width="560" style="
									width: 100%;
									max-width: 560px;
									color: #464646; font-size: 13px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"/>
								</a>
							</td>
						</tr> --}}
						<!-- PARAGRAPH -->
						@if (trim($__env->yieldContent('heading')))
						<tr>
							<td>
								<hr color="#E0E0E0" align="center" width="100%" size="1" noshade="" style="margin: 0; padding: 0;">
							</td>
						</tr>
						@endif
						<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
						<tr>
							<td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
								color: #464646;
								font-family: sans-serif;" class="paragraph">
								@if (trim($__env->yieldContent('greetings')))
									<p id="greetings">Hi @yield('greetings'),<br></p>
								@else
									<p id="greetings">Hi,<br></p>
								@endif
								@yield('content_before_button')
							</td>
						</tr>
						<!-- BUTTON -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
								padding-top: 25px;
								padding-bottom: 5px;" class="button">
								<a href="@yield('button_link')" target="_blank" style="text-decoration: none;">
									<table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
										<tr>
											@if (trim($__env->yieldContent('button_title')))
												<td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: none; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
													bgcolor="#181C32">
													<a target="_blank" style="text-decoration: none;
														color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
														href="@yield('button_link')">
														@yield('button_title')
													</a>
												</td>
											@endif
										</tr>
									</table>
								</a>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
								padding-top: 10px;
								color: #464646;
								font-family: sans-serif;" class="paragraph">
								@yield('content_after_button')
							</td>
						</tr>
						<!-- LINE -->
						<tr>
							<td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
								color: #464646;
								font-family: sans-serif;" class="paragraph">
								<p style="font-weight: bold">
									Regards, <br>
									{{ config('app.name').' Team' }}.
								</p>
							</td>
						</tr>
						<!-- Set line color -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
								padding-top: 25px;" class="line">
							</td>
						</tr>
						<!-- Set line color -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
								padding-top: 25px;" class="line">
								<hr
								color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
							</td>
						</tr>
						<!-- PARAGRAPH -->
						<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
								padding-top: 20px;
								padding-bottom: 25px;
								color: #464646;
								font-family: sans-serif;" class="paragraph">
								Have a&nbsp;question?
								<a href="mailto:support@laperl.com" target="_blank" style="color: #127DB3; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 160%;">
									support@laperl.com
								</a>
							</td>
						</tr>
						<!-- End of WRAPPER -->
					</table>
					<!-- WRAPPER -->
					<!-- Set wrapper width (twice) -->
					<table border="0" cellpadding="0" cellspacing="0" align="center"
						width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
						max-width: 560px;" class="wrapper">
						<!-- SOCIAL NETWORKS -->
						<!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
						<tr style="display: none">
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
								padding-top: 25px;" class="social-icons">
								<table
									width="256" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse: collapse; border-spacing: 0; padding: 0;">
									<tr>
										<!-- ICON 1 -->
										<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
											<a target="_blank"
												href="{{route('tour-listing')}}"
												style="text-decoration: none;">
												<img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
												color: #464646;"
												alt="F" title="Facebook"
												width="44" height="44"
												src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/facebook.png">
											</a>
										</td>
										<!-- ICON 2 -->
										<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
											<a target="_blank"
												href="{{route('tour-listing')}}"
												style="text-decoration: none;">
												<img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
												color: #464646;"
												alt="T" title="Twitter"
												width="44" height="44"
												src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/twitter.png">
											</a>
										</td>
										<!-- ICON 3 -->
										<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
											<a target="_blank"
												href="{{route('tour-listing')}}"
												style="text-decoration: none;">
												<img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
												color: #464646;"
												alt="G" title="Google Plus"
												width="44" height="44"
												src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/googleplus.png">
											</a>
										</td>
										<!-- ICON 4 -->
										<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
											<a target="_blank"
												href="{{route('tour-listing')}}"
												style="text-decoration: none;">
												<img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
												color: #464646;"
												alt="I" title="Instagram"
												width="44" height="44"
												src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/instagram.png">
											</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<!-- FOOTER -->
						<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
						<tr>
							<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
								padding-top: 20px;
								padding-bottom: 20px;
								color: #999999;
								font-family: sans-serif;" class="footer">
								{{-- This email template was sent to&nbsp;you becouse we&nbsp;want to&nbsp;make the&nbsp;world a&nbsp;better place. You&nbsp;could change your
								<a href="{{route('tour-listing')}}" target="_blank" style="text-decoration: underline; color: #999999; font-family: sans-serif; font-size: 13px; font-weight: 400; line-height: 150%;">subscription settings
								</a> anytime.
								<img width="1" height="1" border="0" vspace="0" hspace="0" style="margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"
								src="#" /> --}}
							</td>
						</tr>
						<!-- End of WRAPPER -->
					</table>
					<!-- End of SECTION / BACKGROUND -->
				</td>
			</tr>
		</table>
	</body>
</html>