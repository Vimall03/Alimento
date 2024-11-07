
import { useGlobalDish } from '@/context/dishFormContext';
import { data } from '../components/sidebarConstants';

const Sidebar = () => {
  const {
    dishName,
    dishCategory,
    dishPrice,
    dishDescription,
    dishTags,

    setValidDishName,
    setValidDishCategory,
    setValidDishPrice,
    setValidDishDescription,
    setValidDishTags,

    currentStep,
    setCurrentStep,
    setFormCompleted,
  } = useGlobalDish();

  const changeStep = (id: number) => {
    let allValid = true;

    // Validate each field and update validity states
    if (dishName.trim().length < 1) {
      setValidDishName(false);
      allValid = false;
    } else {
      setValidDishName(true);
    }

    if (dishDescription.trim().length < 1) {
      setValidDishDescription(false);
      allValid = false;
    } else {
      setValidDishDescription(true);
    }

    if (dishPrice < 1) {
      setValidDishPrice(false);
      allValid = false;
    } else {
      setValidDishPrice(true);
    }

    if (dishCategory.trim().length < 1) {
      setValidDishCategory(false);
      allValid = false;
    } else {
      setValidDishCategory(true);
    }

    if (dishTags.length < 1) {
        setValidDishTags(false);
        allValid = false;
      } else {
        setValidDishCategory(true);
      }
    // Move to the next step only if all fields are valid
    if (allValid) {
      setCurrentStep(id);
    }

    // Reset the form completion status
    setFormCompleted(false);
  };

  return (
    <>
      <aside className="bg-[url('/pngFood.png')] bg-cover bg-contain absolute top-0 left-0 right-0 md:relative md:bg-desktop h-[50vh] md:h-full p-8 overflow-hidden md:rounded-xl gap-4 md:gap-0 w-screen md:w-[42.5%] flex flex-row md:flex-col items-start md:justify-start justify-center">
        {data.map((data, index) => {
          const { id, step, title } = data;

          return (
            <div
              key={index}
              className={`flex items-center rounded-lg p-2 space-x-4 leading-4 sm:mb-8 ${currentStep === id ? 'border border-black bg-gray-400 ' : ''}`}
            >
              <div
                onClick={() => changeStep(id)}
                className={`md:w-8 cursor-pointer md:h-8 w-10 h-10 rounded-full flex items-center justify-center font-medium `}
              >
                {id}
              </div>
              <div className="hidden md:block">
                <p className="uppercase font-handlee text-customTeal  text-sm font-medium">
                  {step}
                </p>
                <p className="uppercase font-handlee text-customTeal  font-medium tracking-wider">
                  {title}
                </p>
              </div>
            </div>
          );
        })}
      </aside>
    </>
  );
};

export default Sidebar;
