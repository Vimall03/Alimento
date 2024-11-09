import Link from 'next/link';
import MainNav from '@/components/common/main-nav';
import Container from '@/components/ui/container';
import NavbarActions from './navbar-actions';

export const revalidate = 0;

const Navbar = () => {
  return (
    <div className="border-b">
      <Container>
        <div className="relative px-4 sm:px-6 lg:px-8 flex h-16 items-center">
          <Link
            href="/"
            className="ml-4 h-full items-center justify-center flex lg:ml:0 gap-x-2"
          >
            <p className="font-bold text-4xl">ALIMENTO</p>
          </Link>

          <MainNav />
          <NavbarActions />
        </div>
      </Container>
    </div>
  );
};

export default Navbar;