import transporter from "./nodemailerConfig";

interface EmailOptions {
  to: string;
  subject: string;
  text?: string;
  html?: string;
}

const sendEmail = async ({ to, subject, text, html }: EmailOptions) => {
  // Mail options object
  const mailOptions = {
    from: process.env.SMTP_USER, // Sender email address from environment variable
    to, // Recipient email
    subject,
    text, // Plain text body (optional)
    html, // HTML body (optional)
  };

  try {
    // Send the email and return the response
    const info = await transporter.sendMail(mailOptions);
    console.log('Email sent:', info);
    return info; // Contains messageId, accepted, rejected, etc.
  } catch (error) {
    console.error('Error sending email:', error);
    throw error; // Ensure error is rethrown for proper handling
  }
};

export default sendEmail;
