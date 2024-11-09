import SetUpDishes from '@/components/multistepForm/setupDishes';
import prismadb from '@/lib/prismadb';
import { Dish, Image } from '@prisma/client';
import DishesPage from './components/dishesPage';

interface VendorPageProps {
  params: {
    vendorId: string;
  };
}

export interface DishWithImages extends Dish{
  images:Image[]
}

const VendorPage: React.FC<VendorPageProps> = async ({ params }) => {
  let Dishes: DishWithImages[] | null = [];

  const { vendorId } = await params;
  try {
    Dishes = await prismadb.dish.findMany({
      where: {
        vendorId: vendorId,
      },
      include:{
        images:true
      }
    });
  } catch (err) {
    console.error(
      'Error fetching Dishes',
      err instanceof Error ? err.message : err
    );
  }

    if (Dishes.length){
       return <DishesPage vendorId={vendorId} Dishes={Dishes}/>
    }
  
    else{
      return <SetUpDishes VendorId={vendorId}/>
      // here the guided form component will be added s
    }
 
}
 
export default VendorPage;
