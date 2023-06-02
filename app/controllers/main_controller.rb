class MainController < ApplicationController
  def index
  end

  def create_payment
    # Find keys at https://payment.gctsoft.in/Settings

    token =  ''
    secret = ''
    upiuid = ''
    
    amount = params[:txnAmount].present? ? params[:txnAmount] : "123.0"
    order_id = params[:order_id].present? ? params[:order_id] : "123"
    # callback_url = Rails.application.routes.url_helpers.callback_url(payment_gateway: 'UPI', host: 'localhost', protocol: 'http', port: 3001)
    callback_url = "http://localhost/upi/txnResult.php"

    mobile_no = '1234567890'
    email = "my@email.com"

    php_script = 'app/php/generate_signature.php'
    checksum = `php #{php_script} #{upiuid} #{token} #{order_id} #{amount} TestPayment #{callback_url} #{mobile_no} #{email} #{secret}`
    @payment_params =
    [
      { name: 'upiuid', value: upiuid },
      { name: 'token', value: token },
      { name: 'orderId', value: order_id.to_s },
      { name: 'txnAmount', value: amount },
      { name: 'txnNote', value: "TestPayment" },
      { name: 'callback_url', value: callback_url },
      { name: 'cust_Mobile', value: mobile_no },
      { name: 'cust_Email', value: email },
      { name: 'checksum', value: checksum },
    ]

    # Test path will always return an error
    # @payment_path = "https://payment.gctsoft.in/stage/process".freeze
    @payment_path = "https://payment.gctsoft.in/order/process".freeze

    render 'payment_response'
  end
end
