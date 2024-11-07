import Navbar from "@/components/common/navbar";
import Footer from "@/components/common/footer";

export default function CustomerLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body>
          <Navbar/>
          {children}
          <Footer/>
      </body>
    </html>
  );
}
