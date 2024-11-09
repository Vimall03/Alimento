import VendorNavBar from "@/components/common/vendorNavBar";

export default function VendorLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body>
        <VendorNavBar />
        {children}
      </body>
    </html>
  );
}
