
import { createAnswer } from "@/actions/forum/Answer";
import { createQuestion, getUnansweredQuestions } from "@/actions/forum/Question";
import { NextRequest, NextResponse } from "next/server";

export type Params = Promise<{
  customerId: string;
  questionId : string
}>;

export async function POST(
  request: NextRequest,
  { params }: { params: Params }
) {
  const { customerId , questionId } = await params;

  if (!customerId) {
    return new NextResponse('customer not authenticated', { status: 401 });
  }

  const { content } = await request.json();

  if (!content || !questionId) {
    return new NextResponse('Content and questionId is required', { status: 400 });
  }

  try {
    const resp = await createAnswer(questionId,content);

    if (resp.success) {
      return NextResponse.json(resp.data);
    } else {
      return NextResponse.json({ err: resp.error }, { status: 400 });
    }
  } catch (err) {
    console.log('[CREATE_ANSWER]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}
