
import { getDishById } from "@/actions/dish/dishGET";
import { EditDishForm } from "./components/editDishForm";
import { Image } from "@prisma/client";

type Params = Promise<{ 
  dishId:string,
}> 
const DishPage = async (props:{
  params:Params
}) => {

  const params = await props.params
  const { dishId } = params; 

  console.log(dishId)
  const DishData = await getDishById ({ id:dishId });

  if (!DishData.success || !DishData.data) {
    // Handle error case (e.g., show an error message or redirect)
    return <div>Error fetching Dish: {DishData.error}</div>;
  }

  // Assuming DishData.data has a property 'images' that is an array of objects
  const filteredData = {
    ...DishData.data,
    images: DishData.data.images
      .filter((image: Image) => typeof image.url === 'string' && image.url.startsWith('http')) // Ensure images are URLs
      .map((image: { url: string }) => image.url), // Extract URLs from the image objects
  };

  return (
    <div className="flex-col">
      <div className="flex-1 space-y-4 p-8 pt-6">
        <EditDishForm initialData={filteredData} /> {/* Pass filtered data to the form */}
      </div>
    </div>
  );
};

export default DishPage;
